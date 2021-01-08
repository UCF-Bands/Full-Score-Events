<?php
/**
 * Location display block
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
 * Block for selecting and displaying a location address and/or map
 *
 * @since 1.0.0
 */
class Location extends Post_Block {

	/**
	 * Internal block name
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $name = 'location';

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
				'showAddress' => [
					'type'    => 'boolean',
					'default' => false,
				],
				'showMap'     => [
					'type'    => 'boolean',
					'default' => true,
				],
			]
		);
	}
}
