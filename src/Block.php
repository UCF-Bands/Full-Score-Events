<?php
/**
 * Abstraction of a block
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
 * Base class for registering and handling a block
 *
 * @since 1.0.0
 */
class Block {

	/**
	 * Internal block name
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $name;

	/**
	 * Set everything up
	 *
	 * @param string $name Block name.
	 * @since 1.0.0
	 */
	public function __construct( $name ) {
		$this->name = $name;
		add_action( 'init', [ $this, 'do_registration' ] );
	}

	/**
	 * Register the block with WordPress
	 *
	 * @since  1.0.0
	 */
	public function do_registration() {

		register_block_type(
			"full-score-events/{$this->name}",
			[
				'editor_script' => Blocks::EDITOR_ASSET_HANDLE,
				'editor_style'  => Blocks::EDITOR_ASSET_HANDLE,
				'style'         => Blocks::ASSET_HANDLE,
			]
		);
	}
}
