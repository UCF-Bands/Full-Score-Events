<?php
/**
 * CPT registration handler
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
 * CPT registration, title field placeholder handling, etc.
 *
 * @since 1.0.0
 */
class CPTs {

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', [ __CLASS__, 'do_registration' ] );
		add_action( 'full_score_events_activate', [ __CLASS__, 'do_registration' ] );
		add_action( 'acf/init', [ __CLASS__, 'add_options_pages' ] );
		add_filter( 'enter_title_here', [ __CLASS__, 'set_title_placeholder' ] );
	}

	/**
	 * Fire off CPT registrations
	 *
	 * @since 1.0.0
	 */
	public static function do_registration() {
		register_post_type( Plugin::SAMPLE_KEY, self::get_sample_args() );
	}


	/**
	 * Get sample post type args
	 *
	 * These will not be the same for every custom post type! Go through the
	 * options in the generator and set all labels, support, archive options,
	 * slugs, etc as appropriate. This was reformatted to only return an array,
	 * use the cleaner short array syntax, and line up indexes properly.
	 *
	 * @return array "fse_sample" CPT args
	 *
	 * @todo   Delete this sample.
	 * @see    https://generatewp.com/post-type/
	 * @since  1.0.0
	 */
	public static function get_sample_args() {

		$labels = [
			'name'                  => _x( 'Samples', 'Post Type General Name', 'full-score-events' ),
			'singular_name'         => _x( 'Sample Type', 'Post Type Singular Name', 'full-score-events' ),
			'menu_name'             => __( 'Samples (DELETE)', 'full-score-events' ),
			'name_admin_bar'        => __( 'Sample', 'full-score-events' ),
			'archives'              => __( 'Sample Archives', 'full-score-events' ),
			'attributes'            => __( 'Sample Attributes', 'full-score-events' ),
			'parent_item_colon'     => __( 'Parent Sample:', 'full-score-events' ),
			'all_items'             => __( 'All Samples', 'full-score-events' ),
			'add_new_item'          => __( 'Add New Sample', 'full-score-events' ),
			'add_new'               => __( 'Add New', 'full-score-events' ),
			'new_item'              => __( 'New Sample', 'full-score-events' ),
			'edit_item'             => __( 'Edit Sample', 'full-score-events' ),
			'update_item'           => __( 'Update Sample', 'full-score-events' ),
			'view_item'             => __( 'View Sample', 'full-score-events' ),
			'view_items'            => __( 'View Samples', 'full-score-events' ),
			'search_items'          => __( 'Search Sample', 'full-score-events' ),
			'not_found'             => __( 'Not found', 'full-score-events' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'full-score-events' ),
			'featured_image'        => __( 'Featured Image', 'full-score-events' ),
			'set_featured_image'    => __( 'Set featured image', 'full-score-events' ),
			'remove_featured_image' => __( 'Remove featured image', 'full-score-events' ),
			'use_featured_image'    => __( 'Use as featured image', 'full-score-events' ),
			'insert_into_item'      => __( 'Insert into sample', 'full-score-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this sample', 'full-score-events' ),
			'items_list'            => __( 'Samples list', 'full-score-events' ),
			'items_list_navigation' => __( 'Samples list navigation', 'full-score-events' ),
			'filter_items_list'     => __( 'Filter samples list', 'full-score-events' ),
		];

		$rewrite = [
			'slug'       => 'sample',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		];

		return [
			'label'               => __( 'Sample Type', 'full-score-events' ),
			'description'         => __( 'A sample CPT registration. Delete it.', 'full-score-events' ),
			'labels'              => $labels,
			'supports'            => [ 'title', 'editor', 'thumbnail' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-carrot',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		];
	}

	/**
	 * Register ACF options pages for CPTs
	 *
	 * @since 1.0.0
	 */
	public static function add_options_pages() {

		foreach ( [
			Plugin::SAMPLE_KEY => __( 'Samples Page', 'full-score-events' ),
		] as $key => $title ) {
			acf_add_options_sub_page(
				[
					'post_id'     => $key,
					'page_title'  => $title,
					'menu_title'  => $title,
					'menu_slug'   => sanitize_title( $title ),
					'parent_slug' => 'edit.php?post_type=' . $key,
				]
			);
		}
	}

	/**
	 * Set CPT admin "title" field placeholder
	 *
	 * @param  string $title  Existing placeholder.
	 * @return string $title  New placeholder, if applicable.
	 *
	 * @since 1.0.0
	 */
	public static function set_title_placeholder( $title ) {

		$screen = get_current_screen();

		if ( Plugin::SAMPLE_KEY === $screen->post_type ) {
			$title = __( 'Enter sample\'s name', 'full-score-events' );
		}

		return $title;
	}
}
