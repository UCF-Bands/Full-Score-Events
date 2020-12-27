<?php
/**
 * Schedule display block
 *
 * @since   1.0.0
 * @package Knight_Blocks
 */

namespace Full_Score_Events\Blocks;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block for selecting and displaying a schedule's schedule
 *
 * @since 1.0.0
 */
class Schedule extends Post_Block {

	/**
	 * Internal block name
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $name = 'schedule';

	/**
	 * Get block's attributes
	 *
	 * @return array
	 * @since  1.0.0
	 */
	public function get_attributes() {

		return array_merge(
			parent::get_attributes(),
			[
				'showTitle' => [
					'type'    => 'boolean',
					'default' => false,
				],
			]
		);
	}
}
