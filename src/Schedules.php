<?php
/**
 * Schedule post type + functionality handler
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
 * CPT registration and general "schedules" stuff
 *
 * @since 1.0.0
 */
class Schedules extends Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const CPT_KEY = 'fse_schedule';

	/**
	 * Get general post type label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_label() {
		return __( 'Schedule', 'full-score-events' );
	}

	/**
	 * Get non-default post type args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_cpt_args() {
		return [
			'description'         => __( 'A schedule of events.', 'full-score-events' ),
			'labels'              => [
				'name'                  => _x( 'Schedule', 'Post Type General Name', 'full-score-events' ),
				'menu_name'             => __( 'Schedules', 'full-score-events' ),
				'archives'              => __( 'Schedule Archives', 'full-score-events' ),
				'attributes'            => __( 'Schedule Attributes', 'full-score-events' ),
				'parent_item_colon'     => __( 'Parent Schedule:', 'full-score-events' ),
				'all_items'             => __( 'All Schedules', 'full-score-events' ),
				'add_new_item'          => __( 'Add New Schedule', 'full-score-events' ),
				'new_item'              => __( 'New Schedule', 'full-score-events' ),
				'edit_item'             => __( 'Edit Schedule', 'full-score-events' ),
				'update_item'           => __( 'Update Schedule', 'full-score-events' ),
				'view_item'             => __( 'View Schedule', 'full-score-events' ),
				'view_items'            => __( 'View Schedules', 'full-score-events' ),
				'search_items'          => __( 'Search Schedule', 'full-score-events' ),
				'insert_into_item'      => __( 'Insert into schedule', 'full-score-events' ),
				'uploaded_to_this_item' => __( 'Uploaded to this schedule', 'full-score-events' ),
				'items_list'            => __( 'Schedules list', 'full-score-events' ),
				'items_list_navigation' => __( 'Schedules list navigation', 'full-score-events' ),
				'filter_items_list'     => __( 'Filter schedules list', 'full-score-events' ),
			],
			'supports'            => [ 'title', 'editor', 'custom-fields' ],
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-list-view',
			'show_in_nav_menus'   => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => [
				'slug'       => 'schedule',
				'with_front' => true,
				'pages'      => true,
				'feeds'      => true,
			],
		];
	}

	/**
	 * Register meta
	 *
	 * @since 1.0.0
	 */
	public function do_meta_registration() {

		foreach ( [
			'_schedule_upload' => 'number',
		] as $key => $type ) {
			register_post_meta(
				$this::CPT_KEY,
				$key,
				[
					'type'          => $type,
					'single'        => true,
					'show_in_rest'  => true,
					'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
				]
			);
		}
	}
}
