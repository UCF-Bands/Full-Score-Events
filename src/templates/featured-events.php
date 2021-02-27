<?php
/**
 * Template for displaying the loop of featured events
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/featured-events.php
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

$events = Events::get_featured();

if ( ! $events->have_posts() ) {
	return;
}

$background       = Customizer::get( 'featured_background' );
$background_image = Customizer::get( 'featured_background_image' );

$attrs = [
	'class' => [
		'fse-featured-events',
		$background || $background_image ? 'fse-has-background' : null,
		$background_image ? 'fse-has-background-image' : null,
	],
];
?>

<section <?php do_attrs( $attrs ); ?>>

	<?php
	echo wp_get_attachment_image(
		$background_image,
		[ 1600, 1000 ],
		false,
		[ 'class' => 'fse-featured-events-background fse-cover-image' ]
	);
	?>

	<div class="fse-wrap fse-featured-events-wrap">

		<header <?php do_attrs_class( 'fse-featured-events-header', $background_image ? 'fse-has-background' : null ); ?>>
			<?php
			/**
			 * Hook: full_score_events_featured_header_content
			 *
			 * @hooked Full_Score_Events\do_featured_heading - 10
			 * @hooked Full_Score_Events\do_featured_body - 20
			 */
			do_action( 'full_score_events_featured_header_content' );
			?>
		</header>

		<ul class="fse-featured-events-list">
			<?php
			while ( $events->have_posts() ) :
				$events->the_post();
				?>
				<li class="fse-featured-events-list-event">
					<?php get_plugin_template( 'content', 'event' ); ?>
				</li>
			<?php endwhile; ?>
		</ul>

	</div>
</section>

<?php
wp_reset_postdata();
