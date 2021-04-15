<?php
/**
 * Representation of a staff member
 *
 * This is for a staff post in general, not the block.
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
 * Individual staff member handler
 *
 * @since 1.0.0
 */
class Staff_Member extends Post {

	/**
	 * Get title
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_title() {
		return $this->get( '_title' );
	}

	/**
	 * Get email address
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_email() {
		return $this->get( '_email' );
	}

	/**
	 * Get phone number for attribute (numbers only)
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_phone() {
		return $this->get( '_phone' );
	}

	/**
	 * Get user-facing phone number
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_phone_display() {
		return $this->get( '_phone_display' );
	}
}
