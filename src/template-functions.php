<?php
/**
 * Misc. template functions
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

/**
 * Output opening main wrapper tag
 *
 * @since 1.0.0
 */
function do_content_wrapper() {
	get_plugin_template( 'global/wrapper-open' );
}

/**
 * Output closing main wrapper tag
 *
 * @since 1.0.0
 */
function do_content_wrapper_close() {
	get_plugin_template( 'global/wrapper-close' );
}

/**
 * Output archive header
 *
 * @since 1.0.0
 */
function do_archive_header() {

	if ( is_archive() ) {
		get_plugin_template( 'archive-header' );
	}
}

/**
 * Output featured events loop
 *
 * @since 1.0.0
 */
function do_featured_events() {

	// Only show on first page.
	if ( get_query_var( 'paged' ) ) {
		return;
	}

	get_plugin_template( 'featured-events' );
}

/**
 * Output event date
 *
 * @since 1.0.0
 */
function do_event_date() {
	get_plugin_template( 'event/date' );
}

/**
 * Output main event header contents
 *
 * @since 1.0.0
 */
function do_event_header_content() {
	get_plugin_template( 'event/header-content' );
}

/**
 * Output event registration CTA
 *
 * @since 1.0.0
 */
function do_event_registration() {
	get_plugin_template( 'event/registration' );
}

/**
 * Output event title
 *
 * @since 1.0.0
 */
function do_event_title() {
	$level = is_singular() ? 1 : 2;
	the_title( "<h{$level} class='fse-event-title'>", "</h{$level}>" );
}

/**
 * Output event meta (time and location name)
 *
 * @since 1.0.0
 */
function do_event_meta() {
	get_plugin_template( 'event/meta' );
}

/**
 * Output event excerpt
 *
 * @todo  Shouldn't we just hook in the_excerpt?
 * @since 1.0.0
 */
function do_event_excerpt() {
	the_excerpt();
}

/**
 * Output event link overlay
 *
 * @since 1.0.0
 */
function do_event_link_overlay() {
	get_plugin_template( 'event/link-overlay' );
}

/**
 * Output "all events" link/button
 *
 * @since 1.0.0
 */
function do_all_events_link() {
	get_plugin_template( 'event/all-events-link' );
}

/**
 * Output events loop event header
 *
 * @since 1.0.0
 */
function do_loop_event_header() {
	get_plugin_template( 'event/loop/header' );
}

/**
 * Output event single header
 *
 * @since 1.0.0
 */
function do_single_event_header() {
	get_plugin_template( 'event/single/header' );
}

/**
 * Output event single header wrapper tag
 *
 * @since 1.0.0
 */
function do_single_event_header_wrapper() {
	echo '<div class="fse-event-single-header-wrap">';
}

/**
 * Output event single header wrapper closing tag
 *
 * @since 1.0.0
 */
function do_single_event_header_wrapper_close() {
	echo '</div>';
}

/**
 * Output event single thumbnail (featured image)
 *
 * @since 1.0.0
 */
function do_single_event_thumbnail() {
	the_post_thumbnail( 'large', [ 'class' => 'fse-event-single-thumbnail' ] );
}

/**
 * Output event single main content
 *
 * @since 1.0.0
 */
function do_single_event_content() {
	get_plugin_template( 'event/single/content' );
}

/**
 * Output event single location section
 *
 * @since 1.0.0
 */
function do_single_event_location() {
	get_plugin_template( 'event/single/location' );
}

/**
 * Output event single contact section
 *
 * @since 1.0.0
 */
function do_single_event_contact() {
	get_plugin_template( 'event/single/contact' );
}

/**
 * Output featured events loop header title
 *
 * @since 1.0.0
 */
function do_featured_heading() {
	get_plugin_template( 'event/featured-heading' );
}

/**
 * Output featured events loop header body
 *
 * @since 1.0.0
 */
function do_featured_body() {
	get_plugin_template( 'event/featured-body' );
}
