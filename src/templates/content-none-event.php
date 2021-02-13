<?php
/**
 * Template for displaying the event archive's "none found" message.
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/content-none-event.php
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

<div class="fse-none-found fse-no-events-found">
	<h2 class="fse-none-found-heading"><?php esc_html_e( "There currently aren't any scheduled events.", 'full-score-events' ); ?></h2>
</div>
