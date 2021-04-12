<?php
/**
 * Template for displaying the the "next event" block heading
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/next-event-heading.php
 *
 * However, Full Score Events may need to update template files and you (the
 * theme developer) will need to copy the new file to your theme to maintain
 * compatibility. It is recommended that you make your customizations using
 * hooks/filters to reduce technical debt.
 *
 * @package Full_Score_Events/templates
 * @since   1.0.0
 *
 * @param string $heading
 */

?>

<p class="fse-next-event-heading"><strong><?php echo esc_html( $heading ); ?></strong></p>
