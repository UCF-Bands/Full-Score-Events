<?php
/**
 * Representation of an event
 *
 * This is for an event post in general, not the block.
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

use DateTime;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Individual event handler
 *
 * @since 1.0.0
 */
class Event extends Post {

	/**
	 * Date DateTime cache
	 *
	 * @var   array
	 * @since 1.0.0
	 */
	private $dates = [];

	/**
	 * Get a DateTime object for a date field
	 *
	 * @param  string $which  Which datetime to get from meta (ex: start).
	 * @return DateTime
	 *
	 * @since 1.0.0
	 */
	private function get_date( $which ) {

		// Check cache.
		if ( isset( $this->dates[ $which ] ) ) {
			return $this->dates[ $which ];
		}

		$date = $this->get( "_date_{$which}" );

		$this->dates[ $which ] = $date ? new DateTime( $date ) : false;
		return $this->dates[ $which ];
	}

	/**
	 * Get abbreviated human-readable month
	 *
	 * @param  string $which  Month to get (start or finish).
	 * @return string
	 *
	 * @since  1.0.0
	 */
	private function get_month( $which ) {
		$date = $this->get_date( $which );
		return $date ? $date->format( 'M' ) : false;
	}

	/**
	 * Get day
	 *
	 * @param  string $which   Day to get (start or finish).
	 * @param  string $format  Format to return.
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private function get_day( $which, $format = 'view' ) {
		$date = $this->get_date( $which );

		if ( ! $date ) {
			return false;
		}

		return 'attr' === $format
			? $date->format( 'Y-m-d' )
			: $date->format( 'j' );
	}

	/**
	 * Get the starting date
	 *
	 * @return DateTime
	 * @since 1.0.0
	 */
	public function get_date_start() {
		return $this->get_date( 'start' );
	}

	/**
	 * Get the starting month
	 *
	 * @return string  Abbreviated human-readable month
	 * @since  1.0.0
	 */
	public function get_month_start() {
		return $this->get_month( 'start' );
	}

	/**
	 * Output the starting month
	 *
	 * @since 1.0.0
	 */
	public function do_month_start() {
		echo $this->get_month_start(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Get the starting day of the month
	 *
	 * @param  string $format  Format.
	 * @return string          Start date day of the month.
	 *
	 * @since  1.0.0
	 */
	public function get_day_start( $format = 'view' ) {
		return $this->get_day( 'start', $format );
	}

	/**
	 * Output the starting day of the month
	 *
	 * @param string $format  Format.
	 * @since 1.0.0
	 */
	public function do_day_start( $format = 'view' ) {
		echo $this->get_day_start( $format ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Get the starting time of day
	 *
	 * @return string  Start date time of day.
	 * @since  1.0.0
	 */
	public function get_time_start() {
		$date = $this->get_date_start();
		return $date ? $date->format( 'g:i a' ) : false;
	}

	/**
	 * Get the finishing date
	 *
	 * @return DateTime
	 * @since 1.0.0
	 */
	public function get_date_finish() {
		return $this->get_date( 'finish' );
	}

	/**
	 * Get the finishing month
	 *
	 * @return string  Abbreviated human-readable month
	 * @since  1.0.0
	 */
	public function get_month_finish() {
		return $this->get_month( 'finish' );
	}

	/**
	 * Get the finishing day of the month
	 *
	 * @return string  Finish date day of the month.
	 * @since  1.0.0
	 */
	public function get_day_finish() {
		return $this->get_day( 'finish' );
	}

	/**
	 * Output the finishing day of the month
	 *
	 * @param string $format  Format.
	 * @since 1.0.0
	 */
	public function do_day_finish( $format = 'view' ) {
		echo $this->get_day_finish( $format ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Get the finishing time of day
	 *
	 * @return string  Finish date time of day.
	 * @since  1.0.0
	 */
	public function get_time_finish() {
		$date = $this->get_date_finish();
		return $date ? $date->format( 'g:i a' ) : false;
	}

	public function get_location() {

	}

	public function get_location_title() {

	}
}
