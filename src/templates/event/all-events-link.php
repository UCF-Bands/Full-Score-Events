<?php
/**
 * Template for displaying "all events" link/button
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/all-events-link.php
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

$attrs = apply_filters(
	'full_score_events_all_events_link_attributes',
	[
		'href'  => Events::get_archive_url(),
		'class' => [
			'button',
			'fse-button',
			'fse-all-events-link',
		],
	]
);

$text = apply_filters(
	'full_score_events_all_events_link_text',
	// Translators: View All Events %s.
	sprintf( __( 'View All Events %s', 'full-score-events' ), get_icon( 'calendar' ) )
);
?>

<a <?php do_attrs( $attrs ); ?>><?php echo $text; // phpcs:ignore xss ?></a>
