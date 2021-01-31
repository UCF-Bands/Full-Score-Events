<?php
/**
 * Template for displaying an event's location
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/time.php
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

global $fse_event;

$location = $fse_event->get_location();

if ( ! $location ) {
	return;
}
?>

<section class="fse-event-location">

	<h2 class="fse-event-aside-heading fse-event-location-heading"><?php esc_html_e( 'Location', 'full-score-events' ); ?></h2>

	<?php
	$location->do_map_embed();
	$location->do_address();
	?>

</section>
