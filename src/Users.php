<?php
/**
 * General user/profile handler
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
 * General user and user profile management handler
 *
 * @since 1.0.0
 */
class Users {

	/**
	 * Hook our sections/processors in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'user_contactmethods', [ __CLASS__, 'add_contact_methods' ] );
	}

	/**
	 * Add additional user contact methods
	 *
	 * @param  array $methods  User contact methods.
	 * @return array $methods
	 *
	 * @since 1.0.0
	 */
	public static function add_contact_methods( $methods ) {

		foreach ( [
			'title' => __( 'Title/Position', 'full-score-events' ),
			'phone' => __( 'Phone', 'full-score-events' ),
		] as $key => $label ) {

			// Make sure something else didn't already register it.
			if ( ! empty( $methods[ $key ] ) ) {
				continue;
			}

			$methods[ $key ] = $label;
		}

		return $methods;
	}
}
