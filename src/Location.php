<?php
/**
 * Representation of a location
 *
 * This is for a location post in general, not the block.
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
 * Individual location handler
 *
 * @since 1.0.0
 */
class Location extends Post {

	/**
	 * Get address
	 *
	 * @param  boolean $html  Include HTML.
	 * @param  boolean $title Include title if HTML.
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_address( $html = true, $title = true ) {

		$address = $this->get( '_address' . ( $html ? '_html' : '' ) );

		if ( ! $address ) {
			return;
		}

		if ( $html ) {
			$title = $title ? '<strong class="fse-location-title">' . $this->get_title() . '</strong><br>' : '';
			return "<address class='fse-location-address'>{$title}{$address}</address>";
		} else {
			return $address;
		}
	}

	/**
	 * Output address
	 *
	 * @param boolean $html  Include HTML.
	 * @param boolean $title Include title if HTML.
	 *
	 * @since 1.0.0
	 */
	public function do_address( $html = true, $title = true ) {
		echo $this->get_address( $html, $title ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Get Google Maps place URL
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_map_url() {
		return $this->get( '_map_url' );
	}

	/**
	 * Get Google Place ID
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_place_id() {
		return $this->get( '_place_id' );
	}

	/**
	 * Get map embed SRC
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_map_src() {
		$place_id = $this->get_place_id();

		return $place_id
			? add_query_arg(
				[
					'q'   => "place_id:{$place_id}",
					'key' => Settings::get( 'google' ),
				],
				'https://www.google.com/maps/embed/v1/place'
			)
			: null;
	}

	/**
	 * Get map iframe embed
	 *
	 * Uses Google Maps Embed API. Key must be entered in settings.
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_map_embed() {

		$attrs = [
			'class'       => 'fse-location-map',
			'title'       => __( 'Location map', 'full-score-events' ),
			'width'       => '100%',
			'height'      => '450', // @todo make this a block setting.
			'frameborder' => '0',
			'src'         => $this->get_map_src(),
		];

		return '<iframe ' . get_attrs( $attrs ) . '></iframe>';
	}

	/**
	 * Output map embed
	 *
	 * @since 1.0.0
	 */
	public function do_map_embed() {
		echo $this->get_map_embed(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
