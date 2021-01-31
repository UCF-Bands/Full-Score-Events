<?php
/**
 * Template for displaying an event location's name
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/location-name.php
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

<span class="fse-event-location-name">
	<?php
	do_icon( 'map-marker' );
	$location->do_title();
	?>
</span>
