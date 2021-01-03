<?php
/**
 * Custom taxonomy abstract
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
 * Taxonomy handling abstract
 *
 * @since 1.0.0
 */
abstract class Taxonomy {

	/**
	 * Taxonomy key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const TAX_KEY = 'fse_tax';

	/**
	 * Post types to attach this taxonomy to
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	const POST_TYPES = [];

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'do_registration' ] );
		add_action( 'full_score_events_activate', [ $this, 'do_registration' ] );
	}

	/**
	 * Get main taxonomy label
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_label() {
		return __( 'Set Taxonomy Label', 'full-score-events' );
	}

	/**
	 * Get main plural taxonomy label
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function get_plural_label() {
		return __( 'Set Plural Taxonomy Label', 'full-score-events' );
	}

	/**
	 * Do taxonomy registration
	 *
	 * @since 1.0.0
	 */
	public function do_registration() {
		register_taxonomy(
			$this::TAX_KEY,
			$this::POST_TYPES,
			$this->get_tax_args()
		);
	}

	/**
	 * Get taxonomy args
	 *
	 * @return array Taxonomy registration args.
	 *
	 * @see   https://generatewp.com/taxonomy/
	 * @since 1.0.0
	 */
	protected function get_tax_args() {
		return [];
	}
}
