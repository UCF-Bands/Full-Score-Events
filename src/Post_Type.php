<?php
/**
 * Custom post type handling
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
 * CPT handling abstract
 *
 * @since 1.0.0
 */
abstract class Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const CPT_KEY = 'fse_post_type';

	/**
	 * Registration args
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	protected $cpt_args = [];

	/**
	 * Object class to be used for indivudal instances of the post type
	 *
	 * Ex: If a "Schedule" post type is being setup with "Schedules" as the main
	 * CPT handler (the class extending this class), the "singular class" would
	 * probably be "Schedule" since each item in a loop would be a schedule.
	 *
	 * @var string
	 */
	protected $singular_class = 'Post';

	/**
	 * Flag for global post variable in look
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $loop_global_name = false;


	/**
	 * Singular view redirect flag
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $singular_redirect = false;

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$key = $this::CPT_KEY;
		add_action( 'init', [ $this, 'do_registration' ] );
		add_action( 'full_score_events_activate', [ $this, 'do_registration' ] );
		add_action( 'init', [ $this, 'do_meta_registration' ] );
		add_action( 'pre_get_posts', [ $this, 'maybe_set_query' ] );
		add_filter( 'enter_title_here', [ $this, 'set_title_placeholder' ] );
		add_action( 'the_post', [ $this, 'do_post_setup' ] );
		add_action( 'template_redirect', [ $this, 'do_singular_redirect' ] );
		add_filter( "manage_{$key}_posts_columns", [ $this, 'set_posts_columns' ] );
		add_filter( "manage_edit-{$key}_sortable_columns", [ $this, 'set_sortable_columns' ], 15 );
		add_action( "manage_{$key}_posts_custom_column", [ $this, 'do_custom_column' ], 20, 2 );
	}

	/**
	 * Get main post type label
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_label() {
		return __( 'Set CPT Label', 'full-score-events' );
	}

	/**
	 * Get plural post type label
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_plural_label() {
		return __( 'Set Plural CPT Label', 'full-score-events' );
	}

	/**
	 * Do CPT registration
	 *
	 * @since 1.0.0
	 */
	public function do_registration() {
		register_post_type( $this::CPT_KEY, $this->get_args() );
	}

	/**
	 * Register post type's meta
	 *
	 * @since 1.0.0
	 */
	public function do_meta_registration() {
	}

	/**
	 * Get post type args + defaults
	 *
	 * @return array Custom post type registration args.
	 *
	 * @see    https://generatewp.com/post-type/
	 * @since  1.0.0
	 */
	public function get_args() {

		return array_merge_recursive(
			[
				'label'             => $this->get_label(),
				'labels'            => [
					'name'                  => $this->get_plural_label(),
					'menu_name'             => $this->get_plural_label(),
					'singular_name'         => $this->get_label(),
					'name_admin_bar'        => $this->get_label(),
					'add_new'               => __( 'Add New', 'full-score-events' ),
					'not_found'             => __( 'Not found', 'full-score-events' ),
					'not_found_in_trash'    => __( 'Not found in Trash', 'full-score-events' ),
					'featured_image'        => __( 'Featured Image', 'full-score-events' ),
					'set_featured_image'    => __( 'Set featured image', 'full-score-events' ),
					'remove_featured_image' => __( 'Remove featured image', 'full-score-events' ),
					'use_featured_image'    => __( 'Use as featured image', 'full-score-events' ),
				],
				'hierarchical'      => false,
				'show_in_menu'      => true,
				'menu_position'     => 5,
				'show_in_admin_bar' => true,
				'can_export'        => true,
				'capability_type'   => 'page',
				'show_in_rest'      => true,
			],
			$this->get_cpt_args()
		);
	}

	/**
	 * Get non-default post type args
	 *
	 * @since 1.0.0
	 */
	protected function get_cpt_args() {
		return [];
	}

	/**
	 * Do query setter if we're on the main archive query for this post type.
	 *
	 * @param WP_Query $query  Current query.
	 * @since 1.0.0
	 */
	public function maybe_set_query( $query ) {

		if (
			( $query->is_main_query() && $query->is_post_type_archive( static::CPT_KEY ) )
			|| $query->get( 'post_type' ) === static::CPT_KEY
		) {
			$this->set_query( $query );
		}
	}

	/**
	 * Make adjustments to WP_Query
	 *
	 * It should already be a main query for the current post type's archive.
	 *
	 * @param WP_Query $query  Main query object.
	 * @since 1.0.0
	 */
	protected function set_query( $query ) {
	}

	/**
	 * Get editor title field placeholder
	 *
	 * @return boolean|string
	 * @since  1.0.0
	 */
	protected function get_title_placeholder() {
		return false;
	}

	/**
	 * Set admin "title" field placeholder
	 *
	 * @param  string $title  Existing placeholder.
	 * @return string $title  New placeholder, if applicable.
	 *
	 * @since 1.0.0
	 */
	public function set_title_placeholder( $title ) {

		$screen = get_current_screen();

		return $this::CPT_KEY === $screen->post_type && $this->get_title_placeholder()
			? $this->get_title_placeholder()
			: $title;
	}

	/**
	 * Set up the global custom post type post object
	 *
	 * Inspired by WooCommerce's wc_setup_product_data
	 *
	 * @param  WP_Post $post Post object that is being set up in loop.
	 * @return Product
	 *
	 * @since 1.0.0
	 */
	public function do_post_setup( $post ) {

		if ( ! $this->loop_global_name ) {
			return;
		}

		// Reset prior loop item's global.
		unset( $GLOBALS[ "fse_{$this->loop_global_name}" ] );

		// Make sure it's an actual WP_Post object if it isn't already.
		if ( is_int( $post ) ) {
			$post = get_post();
		}

		// Make sure there's a post type and it's the current CPT handler.
		if ( empty( $post->post_type ) || $this::CPT_KEY !== $post->post_type ) {
			return;
		}

		// Put together the actual class for the object to be created.
		$post_class = 'Full_Score_Events\\' . $this->singular_class;

		// Assign global loop object. Ex: global $fse_schedule will be an
		// instance of Full_Score_Events\Schedule.
		$GLOBALS[ "fse_{$this->loop_global_name}" ] = new $post_class( $post->ID );

		return $GLOBALS[ "fse_{$this->loop_global_name}" ];
	}

	/**
	 * Redirect singular view?
	 *
	 * @since 1.0.0
	 */
	public function do_singular_redirect() {

		if ( ! is_singular( $this::CPT_KEY ) || ! $this->singular_redirect ) {
			return;
		}

		wp_safe_redirect( site_url() );
		exit;
	}

	/**
	 * Manage admin columns
	 *
	 * @param  array $columns Column headings.
	 * @return array $columns
	 *
	 * @since 1.0.0
	 */
	public function set_posts_columns( $columns ) {
		return $columns;
	}

	/**
	 * Manage sortable admin columns
	 *
	 * @param  array $columns  Sortable columns.
	 * @return array $columns
	 *
	 * @since  1.0.0
	 */
	public function set_sortable_columns( $columns ) {
		return $columns;
	}

	/**
	 * Output custom admin column contents
	 *
	 * @param string $name  Column name.
	 * @since 1.0.0
	 */
	public function do_custom_column( $name ) {
		return null;
	}

	/**
	 * Get post type's archive URL
	 *
	 * @return string  Post type archive link/URL.
	 * @since  1.0.0
	 */
	public static function get_archive_url() {
		return get_post_type_archive_link( static::CPT_KEY );
	}
}
