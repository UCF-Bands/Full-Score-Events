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
		add_action( 'init', [ $this, 'do_registration' ] );
		add_action( 'full_score_events_activate', [ $this, 'do_registration' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( "{$key}_add_form_fields", [ $this, 'do_new_term_nonce' ] );
		add_action( "{$key}_edit_form_fields", [ $this, 'do_edit_term_nonce' ] );
		add_action( "created_{$key}", [ $this, 'do_term_nonce_check' ] );
		add_action( "edited_{$key}", [ $this, 'do_term_nonce_check' ] );
	}

	/**
	 * Get main taxonomy label
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_label() {
		return __( 'Set Taxonomy Label', 'full-score-events' );
	}

	/**
	 * Get main plural taxonomy label
	 *
	 * @return string
	 * @since  1.0.0
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
	 * @return array Taxonomy registration args.
	 *
	 * @see   https://generatewp.com/taxonomy/
	 * @since 1.0.0
	 */
	protected function get_tax_args() {
		return [];
	}

	/**
	 * Are we currently on a term creation/edit screen for this taxonomy?
	 *
	 * @return boolean
	 * @since  1.0.0
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
	 * @param WP_Term $term  Term being edited.
	 * @since 1.0.0
	 */
	public function do_edit_term_nonce( $term ) {
		$this->do_term_nonce_field();
		$this->do_edit_term_fields( $term );
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
	 * @param WP_Term $term  Term being edited.
	 * @since 1.0.0
	 */
	protected function do_edit_term_fields( $term ) {
	}

	/**
	 * Perform a nonce check and send to processing
	 *
	 * @param integer $term_id  New or edited term ID.
	 * @since 1.0.0
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
	 * Run term meta saving/updating
	 *
	 * @param integer $term_id  Term ID.
	 * @since 1.0.0
	 */
	public function set_term_meta( $term_id ) {
	}

	/**
	 * Get current query's terms for the taxonomy
	 *
	 * Compatible with archives and singular posts.
	 *
	 * @param  string $fields  Term fields to return. "all" is full term objects.
	 * @return array           Term objects for this taxonomy.
	 *
	 * @since  1.0.0
	 */
	public static function get_current_terms( $fields = 'all' ) {

		$terms = is_archive()
			? get_terms(
				[
					'taxonomy' => static::TAX_KEY,
					'slug'     => explode( ',', get_query_var( static::TAX_KEY ) ),
				]
			)
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
	 * @return string
	 * @since  1.0.0
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
