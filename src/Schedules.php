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
	 * Object class to be used for indivudal instances of the post type
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $singular_class = 'Schedule';

	/**
	 * Flag for global post variable in look
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $loop_global_name = 'schedule';

	/**
	 * Get general post type label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_label() {
		return __( 'Schedule', 'full-score-events' );
	}

	/**
	 * Get plural post type label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_plural_label() {
		return __( 'Schedules', 'full-score-events' );
	}

	/**
	 * Get non-default post type args
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_cpt_args() {
		return [
			'description'         => __( 'A schedule of events.', 'full-score-events' ),
			'labels'              => [
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
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => false,
			'template'            => [
				[ 'full-score-events/schedule-edit' ],
			],
		];
	}

	/**
	 * Get editor title field placeholder
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	protected function get_title_placeholder() {
		return __( 'Add schedule name', 'full-score-events' );
	}

	/**
	 * Add schedule block to main content if there isn't one
	 *
	 * @since 1.0.0
	 *
	 * @param  string $content  Post content.
	 * @return string $content  Post content.
	 */
	protected function get_content( $content ) {

		return ! has_block( 'full-score-events/schedule' )
			? $content . get_block_template( 'schedule' )
			: $content;
	}
}
