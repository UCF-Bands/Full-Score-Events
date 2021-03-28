<?php
/**
 * Template for displaying the featured events' header title
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/featured-heading.php
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

$this_title = Customizer::get( 'featured_title', __( 'Featured Events', 'full-score-events' ) );

if ( ! $this_title ) {
	return;
}
?>

<h3 class="fse-featured-heading"><?php echo $this_title; // phpcs:ignore xss ?></h3>
