<?php
/**
 * Next event block
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
 * Register + handle next event block
 *
 * @since 1.0.0
 */
class Next_Event extends Block {

	/**
	 * Internal block name
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $name = 'next-event';

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
			'heading'   => [
				'type'    => 'string',
				'default' => __( 'Next Event', 'full-score-events' ),
			],
			'ensembles' => [
				'type'    => 'array',
				'default' => [],
			],
		];
	}
}
