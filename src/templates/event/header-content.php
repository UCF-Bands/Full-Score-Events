<?php
/**
 * Template for displaying an event's main header contents
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/header-content.php
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

<div class="fse-event-header-content">
	<?php
	/**
	 * Hook: full_score_events_event_header_content
	 *
	 * @hooked Full_Score_Events\do_event_title - 10
	 * @hooked Full_Score_Events\do_event_meta - 20
	 *
	 * @since 1.0.0
	 */
	do_action( 'full_score_events_event_header_content' );
	?>
</div>
