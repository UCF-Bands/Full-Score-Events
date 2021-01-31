<?php
/**
 * Event post type + functionality handler
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

use DateTime;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Event CPT registration and general handling
 *
 * @since 1.0.0
 */
class Events extends Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const CPT_KEY = 'fse_event';

	/**
	 * Object class to be used for indivudal instances of the post type
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $singular_class = 'Event';

	/**
	 * Flag for global post variable in look
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $loop_global_name = 'event';

	/**
	 * Get general post type label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_label() {
		return __( 'Event', 'full-score-events' );
	}

	/**
	 * Register location meta
	 *
	 * @since 1.0.0
	 */
	public function do_meta_registration() {

		// Set default date in ISO format.
		$date = new DateTime();
		$date = $date->format( 'c' );

		foreach ( [
			'_is_featured'       => [ 'boolean', false ],
			'_date_start'        => [ 'string', $date ],
			'_date_finish'       => [ 'string', $date ],
			'_show_finish'       => [ 'boolean', false ],
			'_is_all_day'        => [ 'boolean', false ],
			'_is_time_tba'       => [ 'boolean', false ],
			'_registration_type' => [ 'string', '' ],
			'_registration_url'  => [ 'string', '' ],
			'_price'             => [ 'number', 0 ],
			'_location_id'       => [ 'integer', 0 ],
			'_contact_id'        => [ 'integer', 0 ],
		] as $key => $args ) {
			register_post_meta(
				self::CPT_KEY,
				$key,
				[
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => $args[0],
					'default'       => $args[1],
					'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
				]
			);
		}
	}

	/**
	 * Get non-default post type args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_cpt_args() {
		return [
			'description'         => __( "Our ensembles' events.", 'full-score-events' ),
			'labels'              => [
				'name'                  => _x( 'Events', 'Post Type General Name', 'full-score-events' ),
				'menu_name'             => __( 'Events', 'full-score-events' ),
				'archives'              => __( 'Event Archives', 'full-score-events' ),
				'attributes'            => __( 'Event Attributes', 'full-score-events' ),
				'parent_item_colon'     => __( 'Parent Event:', 'full-score-events' ),
				'all_items'             => __( 'All Events', 'full-score-events' ),
				'add_new_item'          => __( 'Add New Event', 'full-score-events' ),
				'new_item'              => __( 'New Event', 'full-score-events' ),
				'edit_item'             => __( 'Edit Event', 'full-score-events' ),
				'update_item'           => __( 'Update Event', 'full-score-events' ),
				'view_item'             => __( 'View Event', 'full-score-events' ),
				'view_items'            => __( 'View Events', 'full-score-events' ),
				'search_items'          => __( 'Search Event', 'full-score-events' ),
				'insert_into_item'      => __( 'Insert into event', 'full-score-events' ),
				'uploaded_to_this_item' => __( 'Uploaded to this event', 'full-score-events' ),
				'items_list'            => __( 'Events list', 'full-score-events' ),
				'items_list_navigation' => __( 'Events list navigation', 'full-score-events' ),
				'filter_items_list'     => __( 'Filter events list', 'full-score-events' ),
			],
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions' ],
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-calendar-alt',
			'show_in_nav_menus'   => false,
			'has_archive'         => 'events',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => false,
			'rewrite'             => [
				'slug'       => 'event',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
			],
			'template'            => [
				[
					'core/paragraph',
					[
						'content'   => __( 'Use this introductory paragraph to describe the event. You can also put a heading above it.', 'full-score-events' ),
						'className' => 'is-style-featured',
					],
				],
				[
					'core/heading',
					[ 'content' => __( 'Schedule', 'full-score-events' ) ],
				],
				[ 'full-score-events/schedule' ],
				[
					'core/heading',
					[ 'content' => __( 'Program', 'full-score-events' ) ],
				],
				[ 'full-score-events/program' ],
			],
		];
	}

	// /**
	//  * Manage admin columns
	//  *
	//  * @param  array $columns Column headings.
	//  * @return array $columns
	//  *
	//  * @since 1.0.0
	//  */
	// public function set_posts_columns( $columns ) {

	// 	// Move date column to end.
	// 	$date = $columns['date'] ?? false;
	// 	unset( $columns['date'] );

	// 	$columns['address'] = __( 'Address', 'full-score-events' );

	// 	if ( $date ) {
	// 		$columns['date'] = $date;
	// 	}

	// 	return $columns;
	// }

	// /**
	//  * Set value of custom admin column
	//  *
	//  * @param string $name  Column name.
	//  * @since 1.0.0
	//  */
	// public function do_custom_column( $name ) {

	// 	if ( 'address' !== $name ) {
	// 		return;
	// 	}

	// 	global $fse_location;

	// 	$fse_location->do_address( true, false );

	// 	$map = $fse_location->get_map_url();

	// 	if ( $map ) {
	// 		printf(
	// 			'<a href="%s" target="_blank" rel="nofollow noopener">%s <span class="dashicons dashicons-external"></span></a>',
	// 			esc_attr( $map ),
	// 			esc_html__( 'View Map', 'full-score-events' )
	// 		);
	// 	}
	// }
}
