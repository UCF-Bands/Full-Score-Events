<?php
/**
 * Template for displaying a event loop's event header
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/loop/header.php
 *
 * However, Full Score Events may need to update template files and you (the
 * theme developer) will need to copy the new file to your theme to maintain
 * compatibility. It is recommended that you make your customizations using
 * hooks/filters to reduce technical debt.
 *
 * @package Full_Score_Events/templates
 * @since   1.0.0
 */

global $fse_event;

?>
<header class="fse-events-loop-event-header">
	<?php
	/**
	 * Hook: full_score_events_loop_event_header
	 *
	 * @hooked Full_Score_Events\do_event_date - 15
	 * @hooked Full_Score_Events\do_event_header_content - 30
	 *
	 * @since 1.0.0
	 */
	do_action( 'full_score_events_loop_event_header' );
	?>
</header>
