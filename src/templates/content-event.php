<?php
/**
 * Template for displaying the contents of an event in an archive loop
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/content-event.php
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

?>

<article id="fse-event-<?php the_ID(); ?>" <?php post_class( 'fse-event-card' ); ?>>
	<?php
	/**
	 * Hook: full_score_events_loop_event
	 *
	 * @hooked Full_Score_Events\do_loop_event_header - 10
	 * @hooked Full_Score_Events\the_excerpt - 20
	 * @hooked Full_Score_Events\do_event_link_overlay - 40
	 *
	 * @since 1.0.0
	 */
	do_action( 'full_score_events_loop_event_content' );
	?>
</article>
