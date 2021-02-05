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
		// Global.
		add_action( 'full_score_events_before_main_content', 'Full_Score_Events\do_content_wrapper' );
		add_action( 'full_score_events_after_main_content', 'Full_Score_Events\do_content_wrapper_close' );

		// Archives.
		add_action( 'full_score_events_before_main_content', 'Full_Score_Events\do_archive_header', 50 );

		// Event.
		add_action( 'full_score_events_event_header_content', 'Full_Score_Events\do_event_title' );
		add_action( 'full_score_events_event_header_content', 'Full_Score_Events\do_event_meta', 20 );

		// Events archive event.
		add_action( 'full_score_events_loop_event_content', 'Full_Score_Events\do_loop_event_header' );
		add_action( 'full_score_events_loop_event_content', 'Full_Score_Events\do_event_excerpt', 20 );
		add_action( 'full_score_events_loop_event_content', 'Full_Score_Events\do_event_link_overlay', 40 );

		// Events archive event header.
		add_action( 'full_score_events_loop_event_header', 'Full_Score_Events\do_event_date', 15 );
		add_action( 'full_score_events_loop_event_header', 'Full_Score_Events\do_event_header_content', 30 );

		// Event single.
		add_action( 'full_score_events_single_event_content', 'Full_Score_Events\do_single_event_header' );
		add_action( 'full_score_events_single_event_content', 'Full_Score_Events\do_single_event_thumbnail', 20 );
		add_action( 'full_score_events_single_event_content', 'Full_Score_Events\do_single_event_content', 50 );
		add_action( 'full_score_events_single_event_content', 'Full_Score_Events\do_single_event_location', 70 );
		add_action( 'full_score_events_single_event_content', 'Full_Score_Events\do_single_event_contact', 80 );

		// Event single header.
		add_action( 'full_score_events_single_event_header', 'Full_Score_Events\do_single_event_header_wrapper', 5 );
		add_action( 'full_score_events_single_event_header', 'Full_Score_Events\do_event_date', 15 );
		add_action( 'full_score_events_single_event_header', 'Full_Score_Events\do_event_header_content', 30 );
		add_action( 'full_score_events_single_event_header', 'Full_Score_Events\do_event_registration', 50 );
		add_action( 'full_score_events_single_event_header', 'Full_Score_Events\do_single_event_header_wrapper_close', 100 );
	}
}
