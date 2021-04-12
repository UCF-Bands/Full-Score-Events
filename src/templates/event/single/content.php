<?php
/**
 * Template for displaying an event single's primary contents
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/single/contact.php
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

<div class="entry-content <?php echo esc_attr( 'fse-event-entry-content' ); ?>">
	<?php the_content(); ?>
</div>
