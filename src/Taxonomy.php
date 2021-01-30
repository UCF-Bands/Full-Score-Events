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

	/**
	 * Get current query's terms for the taxonomy
	 *
	 * Compatible with archives and singular posts.
	 *
	 * @param  string $fields  Term fields to return. "all" is full term objects.
	 * @return array           Term objects for this taxonomy.
	 *
	 * @since  1.0.0
	 */
	public static function get_current_terms( $fields = 'all' ) {

		$terms = is_archive()
			? get_terms(
				[
					'taxonomy' => static::TAX_KEY,
					'slug'     => explode( ',', get_query_var( static::TAX_KEY ) ),
				]
			)
			: get_the_terms( get_the_ID(), static::TAX_KEY );

		if ( empty( $terms ) ) {
			return [];
		} elseif ( 'names' === $fields ) {
			return wp_list_pluck( $terms, 'name' );
		} else {
			return $terms;
		}
	}

	/**
	 * Get current query's terms in a human-readable list
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public static function get_current_terms_list() {
		$terms = static::get_current_terms( 'names' );

		// Sanity check.
		if ( ! $terms ) {
			return '';

			// Add "and " to the last term and separate with commas/spaces.
		} elseif ( count( $terms ) > 2 ) {
			$terms[ count( $terms ) - 1 ] = __( 'and', 'full-score-events' ) . ' ' . $terms[ count( $terms ) - 1 ];
			return implode( ', ', $terms );

			// Just two: put "and" between them.
		} else {
			return implode( ' ' . __( 'and', 'full-score-events' ) . ' ', $terms );
		}
	}
}
