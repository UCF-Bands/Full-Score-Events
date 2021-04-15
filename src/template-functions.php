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

	// Only show on first page without ensemble filter.
	if ( get_query_var( 'paged' ) || Ensembles::get_queried() ) {
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

	if ( is_singular( Events::CPT_KEY ) ) {
		$level = 1;
	} elseif ( is_event_archive() ) {
		$level = 2;
	} else {
		$level = 3;
	}

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
 * Output events loop wrapper
 *
 * @since 1.0.0
 */
function do_events_loop_wrapper() {
	echo '<section class="fse-wrap fse-events-loop">';
}

/**
 * Output closing events loop wrapper tag
 *
 * @since 1.0.0
 */
function do_events_loop_wrapper_close() {
	echo '</section>';
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
	echo '<div class="fse-wrap fse-event-single-header-wrap">';
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

	if ( get_post_thumbnail_id() ) {
		the_post_thumbnail(
			apply_filters( 'full_score_events_event_single_thumbnail_size', 'fse-banner' ),
			[ 'class' => 'fse-wrap fse-event-single-thumbnail' ]
		);
	} else {
		echo '<hr class="fse-wrap fse-no-event-thumbnail-divider">';
	}
}

/**
 * Output event single content wrapper tag
 *
 * @since 1.0.0
 */
function do_single_event_content_wrap() {
	?>
	<div <?php do_attrs_class( 'fse-wrap', 'fse-event-content-wrap', get_the_content() ? null : 'fse-event-no-content' ); ?>>
	<?php
}

/**
 * Output closing event single content wrapper tag
 *
 * @since 1.0.0
 */
function do_single_event_content_wrap_close() {
	echo '</div>';
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
 * Output event single "aside" content
 *
 * @since 1.0.0
 */
function do_single_event_aside() {
	get_plugin_template( 'event/single/aside' );
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

/**
 * Output "next event" heading
 *
 * @since 1.0.0
 *
 * @param string $heading  Heading attribute passed into block template.
 */
function do_next_event_heading( $heading ) {

	if ( $heading ) {
		get_plugin_template( 'next-event-heading', '', [ 'heading' => $heading ] );
	}
}

/**
 * Remove inline style attribute from attachment image
 *
 * This was mostly added because Twenty Twentyone inlines height and max-width
 * styles on attachment images.
 *
 * @since 1.0.0
 *
 * @param  array $attr  Attachment image attributes.
 * @return array $attr
 */
function remove_attachment_image_style_attribute( $attr ) {

	// Sanity-check class attribute.
	if ( empty( $attr['class'] ) ) {
		return $attr;
	}

	$blacklist = [ 'fse-cover-image', 'fse-event-single-thumbnail' ];
	$classes   = explode( ' ', $attr['class'] );

	// If any of the images classes are the single-thumb or cover image, bounce
	// the inline CSS.
	if ( array_intersect( $classes, $blacklist ) ) {
		unset( $attr['style'] );
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', __NAMESPACE__ . '\remove_attachment_image_style_attribute', 50 );

/**
 * Set excerpt "more" to ellipsis in event card
 *
 * @since 1.0.0
 *
 * @param  string $excerpt_more  Excerpt "more" text.
 * @return string
 */
function remove_excerpt_more( $excerpt_more ) {

	if ( doing_action( 'full_score_events_loop_event_content' ) ) {
		return '…';
	}

	return $excerpt_more;
}
add_filter( 'excerpt_more', __NAMESPACE__ . '\remove_excerpt_more', 25 );

/**
 * Set event card's excerpt length
 *
 * @since 1.0.0
 *
 * @param  integer $length  Excerpt length.
 * @return integer
 */
function set_excerpt_length( $length ) {

	if ( doing_action( 'full_score_events_loop_event_content' ) ) {
		return 40;
	}

	return $length;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\set_excerpt_length', 25 );

/**
 * Append staff contacts to its post content
 *
 * @since 1.0.0
 *
 * @param  string $content  Staff post content.
 * @return string
 */
function add_staff_contacts_to_content( $content ) {

	if ( Staff::CPT_KEY !== get_post_type() ) {
		return $content;
	}

	ob_start();
	get_plugin_template( 'staff/contacts' );
	return ob_get_clean() . $content;
}
add_filter( 'the_content', __NAMESPACE__ . '\add_staff_contacts_to_content' );

/**
 * Add misc. conditional body classes
 *
 * @since 1.0.0
 *
 * @param  array $classes  Body classes.
 * @return array $classes
 */
function add_body_classes( $classes ) {

	if ( is_event_archive() && Ensembles::get_queried() ) {
		$classes[] = 'fse-ensemble-event-archive';
	}

	if (
		is_event_archive() && ! get_query_var( 'paged' ) // Is first page of main events archive.
		&& ! Ensembles::get_queried()                    // Isn't being filtered to an ensemble(s).
		&& Events::get_featured()->have_posts()          // Has featured events.
	) {
		$classes[] = 'fse-main-event-archive-has-featured-events';
	}

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\add_body_classes' );
