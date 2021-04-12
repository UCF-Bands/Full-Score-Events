<?php
/**
 * Representation of a program
 *
 * This is for a program post in general, not the block.
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
 * Individual program handler
 *
 * @since 1.0.0
 */
class Program extends Post {

	/**
	 * Get program edit block
	 *
	 * @since 1.0.0
	 *
	 * @return array|boolean  Parsed program-edit block.
	 */
	public function get_edit_block() {
		return get_block( 'full-score-events/program-edit', $this->get_id() );
	}
}
