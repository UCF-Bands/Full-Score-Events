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
use NumberFormatter;

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
	 * Location post
	 *
	 * @var   Location
	 * @since 1.0.0
	 */
	private $location;

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
	 * Get time
	 *
	 * @param  string $which   Time to get (start or finish).
	 * @param  string $format  Format to return.
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private function get_time( $which, $format = 'view' ) {
		$date = $this->get_date( $which );

		if ( ! $date ) {
			return false;
		}

		return 'attr' === $format
			? $date->format( 'H:i' )
			: $date->format( 'g:i a' );
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
	 * @param  string $format  Format.
	 * @return string          Start date time of day.
	 *
	 * @since  1.0.0
	 */
	public function get_time_start( $format = 'view' ) {
		return $this->get_time( 'start', $format );
	}

	/**
	 * Output the starting time of day
	 *
	 * @param string $format  Format.
	 * @since 1.0.0
	 */
	public function do_time_start( $format = 'view' ) {
		echo $this->get_time_start( $format ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
	 * @param  string $format  Format.
	 * @return string          Finish date time of day.
	 *
	 * @since  1.0.0
	 */
	public function get_time_finish( $format = 'view' ) {
		return $this->get_time( 'finish', $format );
	}

	/**
	 * Output the finishing time of day
	 *
	 * @param string $format  Format.
	 * @since 1.0.0
	 */
	public function do_time_finish( $format = 'view' ) {
		echo $this->get_time_finish( $format ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Is daily (all-day)?
	 *
	 * @return boolean
	 * @since  1.0.0
	 */
	public function is_daily() {
		return $this->get( '_is_all_day' );
	}

	/**
	 * Is the time TBA?
	 *
	 * @return boolean
	 * @since  1.0.0
	 */
	public function is_time_tba() {
		return $this->get( '_is_time_tba' );
	}

	/**
	 * Display the finish date/time?
	 *
	 * @return boolean
	 * @since  1.0.0
	 */
	public function get_show_finish() {
		return $this->get( '_show_finish' );
	}

	/**
	 * Get location
	 *
	 * @return boolean|Location
	 * @since 1.0.0
	 */
	public function get_location() {

		if ( isset( $this->location ) ) {
			return $this->location;
		}

		$this->location = get_location( $this->get( '_location_id' ) );
		return $this->location;
	}

	/**
	 * Get registration type
	 *
	 * @param  string $format  Raw or human-readable "label" format.
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function get_registration_type( $format = null ) {
		$type = $this->get( '_registration_type' );

		if ( 'label' === $format ) {
			switch ( $type ) {
				case '':
					return false;
				case 'ticket':
					return esc_html__( 'Get Tickets', 'full-score-events' );
				default:
					return esc_html__( 'Register', 'full-score-events' );
			}
		} else {
			return $type;
		}
	}

	/**
	 * Output registration type
	 *
	 * @since 1.0.0
	 */
	public function do_registration_type() {
		echo $this->get_registration_type( 'label' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Get registration URL
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_registration_url() {
		return $this->get( '_registration_url' );
	}

	/**
	 * Should the price be shown?
	 *
	 * @return boolean
	 * @since  1.0.0
	 */
	public function get_show_price() {
		return $this->get( '_show_price' );
	}

	/**
	 * Get price
	 *
	 * @param  string $format  Raw or human-readable "label" format.
	 * @return string|float
	 */
	public function get_price( $format = null ) {
		$price = $this->get( '_price' );

		if ( 'label' === $format ) {
			$formatter = new NumberFormatter( 'en', NumberFormatter::CURRENCY );
			return $price
				? $formatter->formatCurrency( $price, 'USD' )
				: esc_html__( 'Free', 'full-score-events' );
		} else {
			return floatval( $price );
		}
	}

	/**
	 * Output human-readable price
	 *
	 * @since 1.0.0
	 */
	public function do_price() {
		echo $this->get_price( 'label' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
