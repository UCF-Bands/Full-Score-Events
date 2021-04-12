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
	 * @since 1.0.0
	 *
	 * @return array|boolean  Parsed schedule-edit block.
	 */
	public function get_edit_block() {
		return get_block( 'full-score-events/schedule-edit', $this->get_id() );
	}
}
