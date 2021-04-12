<?php
/**
 * Template for displaying an event's "aside" content
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/single/aside.php
 *
 * However, Full Score Events may need to update template files and you (the
 * theme developer) will need to copy the new file to your theme to maintain
 * compatibility. It is recommended that you make your customizations using
 * hooks/filters to reduce technical debt.
 *
 * @package Full_Score_Events/templates
 * @since   1.0.0
 */

?>

<aside class="fse-event-aside">
	<?php
	/**
	 * Hook: full_score_events_single_event_aside
	 *
	 * @hooked Full_Score_Events\do_single_event_location - 10
	 * @hooked Full_Score_Events\do_single_event_contact - 20
	 */
	do_action( 'full_score_events_single_event_aside' );
	?>
</aside>
