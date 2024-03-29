<?php
/**
 * Custom taxonomy abstract
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Taxonomy handling abstract
 *
 * @since 1.0.0
 */
abstract class Taxonomy {

	/**
	 * Taxonomy key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const TAX_KEY = 'fse_tax';

	/**
	 * Post types to attach this taxonomy to
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	const POST_TYPES = [];

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$key = static::TAX_KEY;
		add_action( 'init', [ $this, 'do_init' ] );
		add_action( 'init', [ $this, 'do_registration' ] );
		add_action( 'full_score_events_activate', [ $this, 'do_registration' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_filter( 'get_terms_defaults', [ $this, 'set_terms_query' ], 15, 2 );
		add_action( "{$key}_add_form_fields", [ $this, 'do_new_term_nonce' ] );
		add_action( "{$key}_edit_form_fields", [ $this, 'do_edit_term_nonce' ] );
		add_action( 'quick_edit_custom_box', [ $this, 'do_quick_edit_term_nonce' ], 10, 3 );
		add_action( "created_{$key}", [ $this, 'do_term_nonce_check' ] );
		add_action( "edited_{$key}", [ $this, 'do_term_nonce_check' ] );
		add_action( "saved_{$key}", [ $this, 'do_saved_term' ] );
		add_action( "delete_{$key}", [ $this, 'do_deleted_term' ] );
		add_filter( "manage_edit-{$key}_columns", [ $this, 'add_custom_columns' ] );
		add_filter( "manage_edit-{$key}_sortable_columns", [ $this, 'set_sortable_columns' ], 15 );
		add_filter( "manage_{$key}_custom_column", [ $this, 'set_custom_column' ], 15, 3 );
	}

	/**
	 * Do WP init actions
	 *
	 * @since 1.0.0
	 */
	public function do_init() {
	}

	/**
	 * Get main taxonomy label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_label() {
		return __( 'Set Taxonomy Label', 'full-score-events' );
	}

	/**
	 * Get main plural taxonomy label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_plural_label() {
		return __( 'Set Plural Taxonomy Label', 'full-score-events' );
	}

	/**
	 * Do taxonomy registration
	 *
	 * @since 1.0.0
	 */
	public function do_registration() {
		register_taxonomy(
			$this::TAX_KEY,
			$this::POST_TYPES,
			$this->get_tax_args()
		);
	}

	/**
	 * Get taxonomy args
	 *
	 * @since 1.0.0
	 * @see   https://generatewp.com/taxonomy/
	 *
	 * @return array  Taxonomy registration args.
	 */
	protected function get_tax_args() {
		return [];
	}

	/**
	 * Are we currently on a term creation/edit screen for this taxonomy?
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	protected function is_term_edit() {
		$screen = get_current_screen();
		$base   = $screen->base;

		return static::TAX_KEY === $screen->taxonomy && ( 'term' === $base || 'edit-tags' === $base );
	}

	/**
	 * Enqueue taxonomy-specific admin scripts
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
	}

	/**
	 * Override arguments in get_terms()
	 *
	 * Unfortunatey we have to use get_terms_defaults instead of get_terms_args
	 * because there's an orderby arg bug where 'meta_value_num' (probably
	 * amoung other things) isn't respected:
	 *
	 * @since 1.0.0
	 * @see   https://core.trac.wordpress.org/ticket/42005
	 *
	 * @param  array $defaults    get_terms() default arguments.
	 * @param  array $taxonomies  Taxonomies currently being queried.
	 * @return array $defaults
	 */
	public function set_terms_query( $defaults, $taxonomies ) {
		return $defaults;
	}

	/**
	 * Output a nonce field for the term being edited/created
	 *
	 * @since 1.0.0
	 */
	private function do_term_nonce_field() {
		$key = static::TAX_KEY;
		wp_nonce_field( "{$key}_term_edit", "{$key}_nonce" );
	}

	/**
	 * Output new term nonce and other fields
	 *
	 * @since 1.0.0
	 */
	public function do_new_term_nonce() {
		$this->do_term_nonce_field();
		$this->do_new_term_fields();
	}

	/**
	 * Output term edit nonce and other fields
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Term $term  Term being edited.
	 */
	public function do_edit_term_nonce( $term ) {
		$this->do_term_nonce_field();
		$this->do_edit_term_fields( $term );
	}

	/**
	 * Output term quick edit nonce
	 *
	 * @since 1.0.0
	 *
	 * @param string $column     Current admin column.
	 * @param string $post_type  Post type.
	 * @param string $taxonomy   Taxonomy.
	 */
	public function do_quick_edit_term_nonce( $column, $post_type, $taxonomy ) {

		if ( static::TAX_KEY !== $taxonomy ) {
			return;
		}

		$this->do_term_nonce_field();
	}

	/**
	 * Output new term form fields
	 *
	 * @since 1.0.0
	 */
	protected function do_new_term_fields() {
	}

	/**
	 * Output term edit form fields
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Term $term  Term being edited.
	 */
	protected function do_edit_term_fields( $term ) {
	}

	/**
	 * Perform a nonce check and send to processing
	 *
	 * @since 1.0.0
	 *
	 * @param integer $term_id  New or edited term ID.
	 */
	public function do_term_nonce_check( $term_id ) {
		$key = static::TAX_KEY;

		if (
			check_ajax_referer( "{$key}_term_edit", "{$key}_nonce" ) ||
			check_admin_referer( "{$key}_term_edit", "{$key}_nonce" )
		) {
			$this->set_term_meta( $term_id );
		}
	}

	/**
	 * Do actions on updated/created term
	 *
	 * @since 1.0.0
	 *
	 * @param integer $term_id  Created/updated term ID.
	 */
	public function do_saved_term( $term_id ) {
	}

	/**
	 * Do actions on deleted term
	 *
	 * @since 1.0.0
	 *
	 * @param integer $term_id  Deleted term ID.
	 */
	public function do_deleted_term( $term_id ) {
	}

	/**
	 * Run term meta saving/updating
	 *
	 * @since 1.0.0
	 *
	 * @param integer $term_id  Term ID.
	 */
	public function set_term_meta( $term_id ) {
	}

	/**
	 * Add custom admin columns for term meta
	 *
	 * @since 1.0.0
	 *
	 * @param  array $columns  Term columns.
	 * @return array $columns
	 */
	public function add_custom_columns( $columns ) {
		return $columns;
	}

	/**
	 * Manage sortable term admin columns
	 *
	 * @since 1.0.0
	 *
	 * @param  array $columns  Sortable term columns.
	 * @return array $columns
	 */
	public function set_sortable_columns( $columns ) {
		return $columns;
	}

	/**
	 * Set the contents of one of this taxonomy term's columns
	 *
	 * @since 1.0.0
	 *
	 * @param  string  $content  Column content.
	 * @param  string  $column   Column name.
	 * @param  integer $term_id  Term ID.
	 * @return string  $content
	 */
	public function set_custom_column( $content, $column, $term_id ) {
		return $content;
	}

	/**
	 * Get currently queried terms
	 *
	 * @since  1.0.0
	 *
	 * @return array
	 */
	public static function get_queried() {
		return array_filter( explode( ',', get_query_var( static::TAX_KEY ) ) );
	}

	/**
	 * Get current query's terms for the taxonomy
	 *
	 * Compatible with archives and singular posts.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $fields  Term fields to return. "all" is full term objects.
	 * @return array           Term objects for this taxonomy.
	 */
	public static function get_current_terms( $fields = 'all' ) {

		$terms = is_archive()
			// Only try to grab queried terms if something is actually queried
			// since empty array results in all terms.
			? ( self::get_queried() ? get_terms(
				[
					'taxonomy' => static::TAX_KEY,
					'slug'     => self::get_queried(),
				]
			) : false )
			: get_the_terms( get_the_ID(), static::TAX_KEY );

		if ( empty( $terms ) ) {
			return [];
		} elseif ( 'names' === $fields ) {
			return wp_list_pluck( $terms, 'name' );
		} else {
			return $terms;
		}
	}

	/**
	 * Get current query's terms in a human-readable list
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function get_current_terms_list() {
		$terms = static::get_current_terms( 'names' );

		// Sanity check.
		if ( ! $terms ) {
			return '';

			// Add "and " to the last term and separate with commas/spaces.
		} elseif ( count( $terms ) > 2 ) {
			$terms[ count( $terms ) - 1 ] = __( 'and', 'full-score-events' ) . ' ' . $terms[ count( $terms ) - 1 ];
			return implode( ', ', $terms );

			// Just two: put "and" between them.
		} else {
			return implode( ' ' . __( 'and', 'full-score-events' ) . ' ', $terms );
		}
	}
}
