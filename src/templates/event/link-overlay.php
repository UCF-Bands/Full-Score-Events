<?php
/**
 * Template for displaying an event's "link overlay"
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/link-overlay.php
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
<a href="<?php the_permalink(); ?>" class="fse-event-link-overlay">
	<span class="fse-event-link-overlay-message"><?php esc_html_e( 'View Event', 'full-score-events' ); ?><?php do_icon( 'arrow-right' ); ?></span>
</a>
