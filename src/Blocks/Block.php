<?php
/**
 * Abstraction of a block
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events\Blocks;

use function Full_Score_Events\get_block_template;

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
	 * Does the block render as a template?
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $templated = false;

	/**
	 * Set everything up
	 *
	 * @param string $name  Block name.
	 * @since 1.0.0
	 */
	public function __construct( $name = null ) {
		$this->name = $name ?: $this->name;

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
			array_filter(
				[
					'editor_script'   => Blocks::EDITOR_ASSET_HANDLE,
					'editor_style'    => Blocks::EDITOR_ASSET_HANDLE,
					'style'           => Blocks::ASSET_HANDLE,
					'attributes'      => $this->get_attributes(),
					'render_callback' => $this->templated ? [ $this, 'render' ] : null,
				]
			)
		);

		$this->do_meta_registration();
	}

	/**
	 * Get block's attributes
	 *
	 * @return array
	 * @since  1.0.0
	 */
	protected function get_attributes() {
		return [];
	}

	/**
	 * Do extra meta post meta registration for attribute sourcing
	 *
	 * @since 1.0.0
	 */
	protected function do_meta_registration() {
	}

	/**
	 * Render the block
	 *
	 * Only used if templated.
	 *
	 * @param  array  $attrs   Block's attributes.
	 * @param  string $content Block's contents (InnerBlocks).
	 * @return string          Block HTML.
	 *
	 * @since 1.0.0
	 */
	public function render( $attrs, $content ) {

		if ( $content ) {
			$attrs['content'] = $content;
		}

		return get_block_template( $this->name, $attrs );
	}
}
