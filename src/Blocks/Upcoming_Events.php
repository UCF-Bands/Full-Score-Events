<?php
/**
 * Upcoming events block
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
 * Register + handle upcoming events block
 *
 * @since 1.0.0
 */
class Upcoming_Events extends Block {

	/**
	 * Internal block name
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $name = 'upcoming-events';

	/**
	 * Does the block render as a template?
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $templated = true;

	/**
	 * Get block's attributes
	 *
	 * @return array
	 * @since  1.0.0
	 */
	protected function get_attributes() {
		return [
			'align'     => [
				'type'    => 'string',
				'default' => '',
			],
			'number'    => [
				'type'    => 'number',
				'default' => 3,
			],
			'noneFound' => [
				'type'    => 'string',
				'default' => __( "There aren't any scheduled events at this time.", 'full-score-events' ),
			],
			'ensembles' => [
				'type'    => 'array',
				'default' => [],
			],
		];
	}
}
