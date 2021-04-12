<?php
/**
 * "Renderless" dynamic block
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
 * Register + handle renderless block
 *
 * This allows us to have blocks with inner blocks that don't actually get
 * displayed on the front end and are loaded by other dynamic blocks instead.
 *
 * @since 1.0.0
 */
class Renderless_Block extends Block {

	/**
	 * Render dynamically
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $templated = true;

	/**
	 * Don't render anything
	 *
	 * @since  1.0.0
	 *
	 * @param  array  $attrs    Block's attributes.
	 * @param  string $content  Block's contents (InnerBlocks).
	 * @return string           Block HTML.
	 */
	public function render( $attrs, $content ) {
		return '';
	}
}
