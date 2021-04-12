<?php
/**
 * Template for displaying an event single's content
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/content-single-event.php
 *
 * However, Full Score Events may need to update template files and you (the
 * theme developer) will need to copy the new file to your theme to maintain
 * compatibility. It is recommended that you make your customizations using
 * hooks/filters to reduce technical debt.
 *
 * @package Full_Score_Events/templates
 * @since   1.0.0
 */

namespace Full_Score_Events;

/**
 * Hook: full_score_events_before_single_event
 */
do_action( 'full_score_events_before_single_event' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore XSS
	return;
}
?>
<article id="fse-event-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Hook: full_score_events_single_event_content
	 *
	 * @hooked Full_Score_Events\do_single_event_header - 10
	 * @hooked Full_Score_Events\do_single_event_thumbnail - 20
	 * @hooked Full_Score_Events\do_single_event_content_wrap - 40
	 * @hooked Full_Score_Events\do_single_event_content - 50
	 * @hooked Full_Score_Events\do_single_event_aside - 70
	 * @hooked Full_Score_Events\do_single_event_content_wrap_close - 100
	 *
	 * @since 1.0.0
	 */
	do_action( 'full_score_events_single_event_content' );
	?>
</article>

<?php
/**
 * Hook: full_score_events_after_single_event
 */
do_action( 'full_score_events_after_single_event' );
