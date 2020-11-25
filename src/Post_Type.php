<?php
/**
 * Custom post type handling
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
 * CPT handling abstract
 *
 * @since 1.0.0
 */
abstract class Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $cpt_key = 'fse_';

	/**
	 * Registration args
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	protected $cpt_args = [];

	/**
	 * Title placeholder text
	 *
	 * @since 1.0.0
	 * @var   string|boolean
	 */
	protected $title_placeholder = false;

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'do_registration' ] );
		add_action( 'full_score_events_activate', [ $this, 'do_registration' ] );
		add_filter( 'enter_title_here', [ $this, 'set_title_placeholder' ] );
	}

	/**
	 * Do CPT registration
	 *
	 * @since 1.0.0
	 */
	public function do_registration() {
		register_post_type( $this->cpt_key, $this->get_args() );
	}

	/**
	 * Get main post type label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_label() {
		return __( 'Set CPT Label', 'full-score-events' );
	}

	/**
	 * Get post type args + defaults
	 *
	 * @return array Custom post type registration args.
	 *
	 * @see    https://generatewp.com/post-type/
	 * @since  1.0.0
	 */
	public function get_args() {

		return array_merge(
			[
				'label'             => $this->get_label(),
				'labels'            => [
					'singular_name'         => $this->get_label(),
					'name_admin_bar'        => $this->get_label(),
					'add_new'               => __( 'Add New', 'full-score-events' ),
					'not_found'             => __( 'Not found', 'full-score-events' ),
					'not_found_in_trash'    => __( 'Not found in Trash', 'full-score-events' ),
					'featured_image'        => __( 'Featured Image', 'full-score-events' ),
					'set_featured_image'    => __( 'Set featured image', 'full-score-events' ),
					'remove_featured_image' => __( 'Remove featured image', 'full-score-events' ),
					'use_featured_image'    => __( 'Use as featured image', 'full-score-events' ),
				],
				'hierarchical'      => false,
				'show_in_menu'      => true,
				'menu_position'     => 5,
				'show_in_admin_bar' => true,
				'can_export'        => true,
				'capability_type'   => 'page',
				'show_in_rest'      => true,
			],
			$this->get_cpt_args()
		);
	}

	/**
	 * Get non-default post type args
	 *
	 * @since 1.0.0
	 */
	protected function get_cpt_args() {
		return [];
	}

	/**
	 * Set admin "title" field placeholder
	 *
	 * @param  string $title  Existing placeholder.
	 * @return string $title  New placeholder, if applicable.
	 *
	 * @since 1.0.0
	 */
	public function set_title_placeholder( $title ) {

		$screen = get_current_screen();

		return $this->title_placeholder && $this->cpt_key === $screen->post_type
			? $this->title_placeholder
			: $title;
	}
}
