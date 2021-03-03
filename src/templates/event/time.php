<?php
/**
 * Template for displaying an event's time
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

// Do sanity check.
if ( ! $fse_event->get_time_start() ) {
	return;
}
?>

<span class="fse-event-time">
	<?php
	do_icon( 'clock' );
	echo ' ';

	if ( $fse_event->is_time_tba() ) :
		echo esc_html__( 'TBA', 'full-score-events' ) . '</span>';
		return;
	endif;

	if ( $fse_event->is_daily() ) :
		esc_html_e( 'Daily', 'full-score-events' );
	else :
		?>
		<time datetime="<?php $fse_event->do_time_start( 'attr' ); ?>"><?php $fse_event->do_time_start(); ?></time>
		<?php
	endif;

	if ( $fse_event->get_show_finish() && $fse_event->get_day_start() === $fse_event->get_day_finish() ) :
		?>
		<span class="fse-time-separator"> – </span>
		<time datetime="<?php $fse_event->do_time_finish( 'attr' ); ?>"><?php $fse_event->do_time_finish(); ?></time>
	<?php endif; ?>
</span>
