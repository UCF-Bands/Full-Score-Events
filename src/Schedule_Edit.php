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
			Schedules::CPT_KEY,
			'_schedule_items',
			[
				'single'        => true,
				'type'          => 'string',
				'default'       => '[]',
				'show_in_rest'  => true,
				'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
			]
		);
	}
}
