<?php
/**
 * Schedule editing block
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
 * Register + handle schedule editing block
 *
 * @since 1.0.0
 */
class Schedule_Edit extends Block {

	/**
	 * Internal block name
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $name = 'schedule-edit';

	/**
	 * Do extra meta post meta registration for attribute sourcing
	 *
	 * @since 1.0.0
	 */
	protected function do_meta_registration() {

		register_post_meta(
			'',
			// Schedules::CPT_KEY,
			'_krik',
			[
				'show_in_rest'  => true,
				'single'        => true,
				'type'          => 'string',
				'auth_callback' => function() {
					return current_user_can( 'edit_posts' );
				},
				// 'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
			]
		);

		// d( $rick, Schedules::CPT_KEY ); die;

		// register_post_meta(
		// 	Schedules::CPT_KEY,
		// 	'_schedule_items',
		// 	[
		// 		'single'        => true,
		// 		'type'          => 'array',
		// 		'show_in_rest'  => [
		// 			'schema' => [
		// 				'items' => [
		// 					'type'       => 'object',
		// 					'properties' => [
		// 						'time'     => [ 'type' => 'string' ],
		// 						'activity' => [ 'type' => 'string' ],
		// 					],
		// 				],
		// 			],
		// 		],
		// 		'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
		// 	]
		// );
	}
}
