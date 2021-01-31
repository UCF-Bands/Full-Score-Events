<?php
/**
 * Template for displaying single events
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/single-event.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header( 'event' );
?>

<?php
/**
 * Hook: full_score_events_before_main_content
 *
 * @hooked Full_Score_Events\do_content_wrapper - 10
 */
do_action( 'full_score_events_before_main_content' );
?>

	<?php
	while ( have_posts() ) :
		the_post();
		get_plugin_template( 'content', 'single-event' );
	endwhile;
	?>

<?php
/**
 * Hook: full_score_events_after_main_content
 *
 * @hooked Full_Score_Events\do_content_wrapper_close - 10
 */
do_action( 'full_score_events_after_main_content' );
?>

<?php
get_footer( 'event' );
