<?php
/**
 * Next event block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

$events = Events::get_upcoming( 1, $ensembles );

// Don't output block at all if there aren't any events.
if ( ! $events->have_posts() ) {
	return;
}
?>

<div <?php do_attrs_class( 'fse-next-event', $className ?? '' ); ?>>
	<?php
	/**
	 * Hook: full_score_events_before_next_event
	 */
	do_action( 'full_score_events_before_next_event' );

	while ( $events->have_posts() ) :
		$events->the_post();
		?>
			<?php get_plugin_template( 'content', 'next-event', [ 'heading' => $heading ] ); ?>
		<?php
	endwhile;
	wp_reset_postdata();

	/**
	 * Hook: full_score_events_after_next_event
	 */
	do_action( 'full_score_events_after_next_event' );
	?>
</div>
