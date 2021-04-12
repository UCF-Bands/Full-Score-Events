<?php
/**
 * Schedule item block
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events\Blocks;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register + handle schedule item block
 *
 * @since 1.0.0
 */
class Schedule_Item extends Block {

	/**
	 * Internal block name
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $name = 'schedule-item';

	/**
	 * Render dynamically
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $templated = true;

	/**
	 * Define block attributes
	 *
	 * @since  1.0.0
	 *
	 * @return array
	 */
	protected function get_attributes() {

		return [
			'dateTime' => [
				'type'    => 'string',
				'default' => '',
			],
		];
	}
}
