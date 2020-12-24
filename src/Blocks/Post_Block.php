<?php
/**
 * Base for a dynamically-rendered "selected post" block
 *
 * @since   1.0.0
 * @package Knight_Blocks
 */

namespace Full_Score_Events\Blocks;

use function Full_Score_Events\get_block_template;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * "Selected post" dynamic block functionality
 *
 * @since 1.0.0
 */
class Post_Block extends Block {

	/**
	 * Render dynamically
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
	public function get_attributes() {

		return [
			'selectedPost' => [
				'type'    => 'object',
				'default' => [
					'label' => 'string',
					'value' => 'string',
				],
			],
		];
	}

	/**
	 * Render the block
	 *
	 * @param  array  $attrs   Block's attributes.
	 * @param  string $content Block's contents (InnerBlocks).
	 * @return string          Block HTML.
	 *
	 * @since 1.0.0
	 */
	public function render( $attrs, $content ) {

		// Do sanity check.
		if ( ! $attrs['selectedPost']['value'] ) {
			return '';
		}

		global $post;

		// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$post = $attrs['selectedPost']['value'];
		setup_postdata( $post );

		if ( $content ) {
			$attrs['content'] = $content;
		}

		// Get templates/block/name.php.
		$block = get_block_template( $this->name, $attrs );

		wp_reset_postdata();

		return $block;
	}
}
