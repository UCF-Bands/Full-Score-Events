<?php
/**
 * Upcoming events block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

$events = Events::get_upcoming();
?>

<div <?php do_attrs_class( 'fse-upcoming-events', $className ?? '' ); ?>>
	<?php
	/**
	 * Hook: full_score_events_before_upcoming_events
	 */
	do_action( 'full_score_events_before_upcoming_events' );
	?>

	<?php if ( $events->have_posts() ) : ?>

		<ul class="fse-upcoming-events-list">
			<?php
			while ( $events->have_posts() ) :
				$events->the_post();
				?>
				<li class="fse-upcoming-event">
					<?php get_plugin_template( 'content', 'event' ); ?>
				</li>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</ul>

	<?php else : ?>

		<div class="fse-no-upcoming-events">
			<p><?php esc_html_e( "There aren't any scheduled events at this time.", 'full-score-events' ); ?></p>
		</div>

	<?php endif; ?>

	<?php
	/**
	 * Hook: full_score_events_after_upcoming_events
	 */
	do_action( 'full_score_events_after_upcoming_events' );
	?>
</div>
