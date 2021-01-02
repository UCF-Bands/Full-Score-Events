<?php
/**
 * Representation of a schedule
 *
 * This is for a schedule post in general, not the block.
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
 * Individual schedule handler
 *
 * @since 1.0.0
 */
class Schedule extends Post {

	/**
	 * Get schedule edit block
	 *
	 * @return array|boolean  Parsed schedule-edit block.
	 * @since  1.0.0
	 */
	public function get_edit_block() {

		$block_name = 'full-score-events/schedule-edit';

		if ( ! has_block( $block_name, $this->get_id() ) ) {
			return false;
		}

		$post   = get_post( $this->get_id() );
		$blocks = parse_blocks( $post->post_content );
		$blocks = wp_list_filter( $blocks, [ 'blockName' => $block_name ] );

		if ( ! $blocks ) {
			return;
		}

		// Always just use one edit block.
		return $blocks[0];
	}
}
