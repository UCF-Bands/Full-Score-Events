<?php
/**
 * Template for displaying an event single's header
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/single/header.php
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
<header class="fse-event-single-header">
	<?php
	/**
	 * Hook: full_score_events_single_event_header
	 *
	 * @hooked Full_Score_Events\do_single_event_header_wrapper - 5
	 * @hooked Full_Score_Events\do_single_event_date - 15
	 * @hooked Full_Score_Events\do_single_event_header_content - 30
	 * @hooked Full_Score_Events\do_single_event_registration - 50
	 * @hooked Full_Score_Events\do_single_event_header_wrapper_close - 100
	 *
	 * @since 1.0.0
	 */
	do_action( 'full_score_events_single_event_header' );
	?>
</header>
