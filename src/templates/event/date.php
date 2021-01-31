<?php
/**
 * Template for displaying an event's date
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/date.php
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

// Do sanity check.
if ( ! $fse_event->get_date_start() ) {
	return;
}
?>

<time datetime="<?php $fse_event->do_day_start( 'attr' ); ?>" class="fse-date">
	<span class="fse-date-days">
		<?php
		$fse_event->do_day_start();
		if ( $fse_event->get_day_start() !== $fse_event->get_day_finish() ) :
			echo '<span class="fse-days-separator">–</span>';
			$fse_event->do_day_finish();
		endif;
		?>
	</span>
	<span class="fse-date-month">
		<?php $fse_event->do_month_start(); ?>
	</span>
</time>
