<?php
/**
 * Location post type + functionality handler
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
 * Location CPT registration and general handling
 *
 * @since 1.0.0
 */
class Locations extends Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const CPT_KEY = 'fse_location';

	/**
	 * Object class to be used for indivudal instances of the post type
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	// protected $singular_class = 'Location';

	/**
	 * Flag for global post variable in look
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	// protected $loop_global_name = 'location';

	/**
	 * Singular view redirect flag
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $singular_redirect = true;

	/**
	 * Get general post type label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_label() {
		return __( 'Location', 'full-score-events' );
	}

	/**
	 * Get non-default post type args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_cpt_args() {
		return [
			'description'         => __( 'Event venues.', 'full-score-events' ),
			'labels'              => [
				'name'                  => _x( 'Locations', 'Post Type General Name', 'full-score-events' ),
				'menu_name'             => __( 'Locations', 'full-score-events' ),
				'archives'              => __( 'Location Archives', 'full-score-events' ),
				'attributes'            => __( 'Location Attributes', 'full-score-events' ),
				'parent_item_colon'     => __( 'Parent Location:', 'full-score-events' ),
				'all_items'             => __( 'All Locations', 'full-score-events' ),
				'add_new_item'          => __( 'Add New Location', 'full-score-events' ),
				'new_item'              => __( 'New Location', 'full-score-events' ),
				'edit_item'             => __( 'Edit Location', 'full-score-events' ),
				'update_item'           => __( 'Update Location', 'full-score-events' ),
				'view_item'             => __( 'View Location', 'full-score-events' ),
				'view_items'            => __( 'View Locations', 'full-score-events' ),
				'search_items'          => __( 'Search Location', 'full-score-events' ),
				'insert_into_item'      => __( 'Insert into location', 'full-score-events' ),
				'uploaded_to_this_item' => __( 'Uploaded to this location', 'full-score-events' ),
				'items_list'            => __( 'Locations list', 'full-score-events' ),
				'items_list_navigation' => __( 'Locations list navigation', 'full-score-events' ),
				'filter_items_list'     => __( 'Filter locations list', 'full-score-events' ),
			],
			'supports'            => [ 'title', 'editor', 'custom-fields' ],
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-location',
			'show_in_nav_menus'   => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => false,
			// 'rewrite'             => [
			// 	'slug'       => 'program',
			// 	'with_front' => true,
			// 	'pages'      => true,
			// 	'feeds'      => true,
			// ],
			'template'            => [
				// [ 'full-score-events/location-details' ],
			],
		];
	}
}
