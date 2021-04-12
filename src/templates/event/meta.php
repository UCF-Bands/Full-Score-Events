<?php
/**
 * Template for displaying an event's time and location name
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/meta.php
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

<div class="fse-event-meta">
	<?php get_plugin_template( 'event/time' ); ?>
	<?php get_plugin_template( 'event/location-name' ); ?>
</div>
