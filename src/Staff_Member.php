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
	 * Get position
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_position() {
		return $this->get( '_position' );
	}

	/**
	 * Output position
	 *
	 * @since 1.0.0
	 */
	public function do_position() {
		echo esc_html( $this->get_position() );
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
	 * Output email
	 *
	 * @since 1.0.0
	 */
	public function do_email() {
		echo esc_html( $this->get_email() );
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
	 * Output phone number for attribute (numbers only)
	 *
	 * @since 1.0.0
	 */
	public function do_phone() {
		echo esc_attr( $this->get_phone() );
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

	/**
	 * Output user-facing phone number
	 *
	 * @since 1.0.0
	 */
	public function do_phone_display() {
		echo esc_html( $this->get_phone_display() );
	}

	/**
	 * Get user-facing Facebook link label/text
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_facebook_label() {
		return $this->get( '_facebook_label' ) ?: __( 'Facebook', 'full-score-events' );
	}

	/**
	 * Output user-facing Facebook link label/text
	 *
	 * @since 1.1.0
	 */
	public function do_facebook_label() {
		echo esc_html( $this->get_facebook_label() );
	}

	/**
	 * Get Facebook URL
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_facebook_url() {
		return esc_url( $this->get( '_facebook_url' ) );
	}

	/**
	 * Output Facebook URL
	 *
	 * @since 1.1.0
	 */
	public function do_facebook_url() {
 		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->get_facebook_url();
	}

	/**
	 * Get user-facing Discord link label/text
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_discord_label() {
		return $this->get( '_discord_label' ) ?: __( 'Discord', 'full-score-events' );
	}

	/**
	 * Output user-facing Facebook link label/text
	 *
	 * @since 1.1.0
	 */
	public function do_discord_label() {
		echo esc_html( $this->get_discord_label() );
	}

	/**
	 * Get Discord URL
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_discord_url() {
		return esc_url( $this->get( '_discord_url' ) );
	}

	/**
	 * Output Facebook URL
	 *
	 * @since 1.1.0
	 */
	public function do_discord_url() {
 		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->get_discord_url();
	}
}
