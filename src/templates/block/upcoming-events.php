<?php
/**
 * Upcoming events block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

$events = Events::get_upcoming();

// Don't output block at all if there aren't any events and no message.
if ( ! $events->have_posts() && ! $noneFound ) {
	return;
}
?>

<div <?php do_attrs_class( 'fse-upcoming-events', $className ?? '', "align{$align}" ); ?>>
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
					<?php get_plugin_template( 'content', 'upcoming-event' ); ?>
				</li>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</ul>

	<?php else : ?>

		<div class="fse-no-upcoming-events">
			<p><?php echo wp_kses( $noneFound, get_allowed_inline_html() ); ?></p>
		</div>

	<?php endif; ?>

	<?php
	/**
	 * Hook: full_score_events_after_upcoming_events
	 *
	 * @hooked Full_Score_Events\do_all_events_link - 10
	 */
	do_action( 'full_score_events_after_upcoming_events' );
	?>
</div>
