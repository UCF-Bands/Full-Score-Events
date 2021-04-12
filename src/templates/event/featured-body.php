<?php
/**
 * Template for displaying the featured events' header body content
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/featured-body.php
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

$body = Customizer::get( 'featured_body' );

if ( ! $body ) {
	return;
}
?>

<div class="fse-featured-body">
	<?php echo wp_kses_post( wpautop( $body ) ); ?>
</div>
