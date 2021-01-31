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

$this_type = $fse_event->get_registration_type();
$this_tag  = $this_type ? 'a' : 'span';
$attrs     = [
	'class' => [
		'button',
		$this_type ? 'fse-event-registration-button' : 'fse-event-registration-label',
	],
	'href'  => $this_type ? $fse_event->get_registration_url() : null,
	'role'  => $this_type ? 'button' : null,
];
?>

<<?php echo esc_attr( $this_tag ); ?> <?php do_attrs( $attrs ); ?>>

	<?php if ( $this_type ) : ?>
		<span class="fse-event-registration-type">
			<?php $fse_event->do_registration_type(); ?>
		</span>
	<?php endif; ?>

	<?php if ( $this_type && $fse_event->get_show_price() ) : ?>
		<span class="fse-event-registration-separator">|</span>
	<?php endif; ?>

	<?php if ( $fse_event->get_show_price() ) : ?>
		<span class="fse-event-price"><?php $fse_event->do_price(); ?></span>
	<?php endif; ?>

</<?php echo esc_attr( $this_tag ); ?>>