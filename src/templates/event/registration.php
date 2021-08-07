<?php
/**
 * Template for displaying an event's registration call to action button
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/registration.php
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

global $fse_event;

$this_type  = $fse_event->get_registration_type();
$show_price = $fse_event->get_show_price();

if ( ! $this_type && ! $show_price ) {
	return;
}

$this_tag = $this_type ? 'a' : 'span';
$attrs    = apply_filters(
	'full_score_events_registration_link_attrs',
	[
		'class' => [
			'wp-block-button__link',
			'fse-button',
			$this_type ? 'fse-event-registration-button' : 'fse-event-registration-label',
		],
		'href'  => $this_type ? $fse_event->get_registration_url() : null,
		'role'  => $this_type ? 'button' : null,
		'title' => $this_type ? null : __( 'Registration is not required for this event.', 'full-score-events' ),
	]
);
?>

<<?php echo esc_attr( $this_tag ); ?> <?php do_attrs( $attrs ); ?>>

	<?php if ( $this_type ) : ?>
		<span class="fse-event-registration-type">
			<?php $fse_event->do_registration_label(); ?>
		</span>
	<?php endif; ?>

	<?php if ( $this_type && $show_price ) : ?>
		<span class="fse-event-registration-separator">|</span>
	<?php endif; ?>

	<?php if ( $show_price ) : ?>
		<span class="fse-event-price"><?php $fse_event->do_price(); ?></span>
	<?php endif; ?>

</<?php echo esc_attr( $this_tag ); ?>>
