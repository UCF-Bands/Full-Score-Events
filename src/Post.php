<?php
/**
 * Abstraction of a post
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
 * Base class for setting post's basic things and getting cached meta
 *
 * @since 1.0.0
 */
abstract class Post {

	/**
	 * Associated post ID
	 *
	 * @var   integer
	 * @since 1.0.0
	 */
	private $id;

	/**
	 * Meta cache
	 *
	 * @var   array
	 * @since 1.0.0
	 */
	private $meta = [];

	/**
	 * Set everything up
	 *
	 * @param integer $post_id Associated post ID.
	 * @since 1.0.0
	 */
	public function __construct( $post_id = null ) {
		$this->id = $post_id ?? get_the_ID();
	}

	/**
	 * Get post ID
	 *
	 * @return integer
	 * @since  1.0.0
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Check and retrive something from the post's meta
	 *
	 * @param  string $key Meta key/field.
	 * @return mixed
	 *
	 * @since  1.0.0
	 */
	protected function get( $key ) {

		if ( isset( $this->meta[ $key ] ) ) {
			return $this->meta[ $key ];
		}

		$this->meta[ $key ] = \get_post_meta( $this->get_id(), $key, true );
		return $this->meta[ $key ];
	}

	/**
	 * Get post title
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_title() {
		return \get_the_title( $this->get_id() );
	}

	/**
	 * Output post title
	 *
	 * @since  1.0.0
	 */
	public function do_title() {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->get_title();
	}
}
