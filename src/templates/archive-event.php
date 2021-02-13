<?php
/**
 * Template for displaying the events archive
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/archive-event.php.
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
 * @hooked Full_Score_Events\do_archive_header - 50
 */
do_action( 'full_score_events_before_main_content' );
?>

	<?php if ( have_posts() ) : ?>

		<?php
		/**
		 * Hook: full_score_events_loop_before_events
		 */
		do_action( 'full_score_events_loop_before_events' );

		while ( have_posts() ) :
			the_post();
			get_plugin_template( 'content', 'event' );
		endwhile;

		/**
		 * Hook: full_score_events_loop_after_events
		 *
		 * @hooked the_posts_pagination - 10
		 */
		do_action( 'full_score_events_loop_after_events' );
		?>

	<?php else : ?>
		NO POSTS G
	<?php endif; ?>

<?php
/**
 * Hook: full_score_events_after_main_content
 *
 * @hooked Full_Score_Events\do_content_wrapper_end - 10
 */
do_action( 'full_score_events_after_main_content' );
?>

<?php
get_footer( 'event' );
