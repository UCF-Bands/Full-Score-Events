<?php
/**
 * Template for displaying a season's "label".
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/season/label.php
 *
 * However, Full Score Events may need to update template files and you (the
 * theme developer) will need to copy the new file to your theme to maintain
 * compatibility. It is recommended that you make your customizations using
 * hooks/filters to reduce technical debt.
 *
 * @package Full_Score_Events/templates
 * @since   1.0.0
 *
 * @param integer $id    Season term ID.
 * @param string  $date  Season term "start date" meta (Ymd).
 * @param string  $name  Season term name.
 */

$date = DateTime::createFromFormat( 'Ymd', $date );
?>

<h3 class="fse-season-label">
	<?php echo esc_html( $name ); ?>
	<small class="fse-season-label-year">
		<?php echo esc_html( $date->format( 'Y' ) ); ?>
	</small>
</h3>
