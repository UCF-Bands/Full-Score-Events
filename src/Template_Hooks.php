<?php
/**
 * Template hooking
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
 * Template hooks
 *
 * Action/filter hooks used for WooCommerce functions/templates.
 *
 * @since 1.0.0
 */
class Template_Hooks {

	/**
	 * Hook things in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'full_score_events_before_main_content', 'Full_Score_Events\output_content_wrapper' );
		add_action( 'full_score_events_after_main_content', 'Full_Score_Events\output_content_wrapper_close' );

		add_action( 'full_score_events_before_main_content', 'Full_Score_Events\output_archive_header', 50 );
	}
}
