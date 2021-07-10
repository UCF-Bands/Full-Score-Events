<?php
/**
 * Template for displaying an event's primary contact
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/event/single/contact.php
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

$contact = $fse_event->get_contact();

if ( ! $contact ) {
	return;
}
?>

<section class="fse-event-contact">

	<h2 class="fse-event-aside-heading fse-event-contact-heading"><?php esc_html_e( 'Event Contact', 'full-score-events' ); ?></h2>

	<address class="fse-contact-card">
		<?php echo get_the_post_thumbnail( $contact->get_id(), [ 94, 94 ] ); ?>

		<div class="fse-contact-card-details">
			<strong class="fse-contact-card-name"><?php $contact->do_title(); ?></strong>

			<?php if ( $contact->get_position() ) : ?>
				<span class="fse-contact-title"><?php $contact->do_position(); ?></span>
			<?php endif; ?>

			<div class="fse-contact-card-methods">
				<?php if ( $contact->get_email() ) : ?>
					<a href="mailto:<?php $contact->do_email(); ?>" class="fse-contact-method fse-contact-email">
						<?php do_icon( 'envelope' ); ?>
						<?php $contact->do_email(); ?>
					</a>
				<?php endif; ?>

				<?php if ( $contact->get_phone() ) : ?>
					<a href="tel:<?php $contact->do_phone(); ?>" class="fse-contact-method fse-contact-phone">
						<?php do_icon( 'phone' ); ?>
						<?php $contact->do_phone_display(); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</address>

</section>
