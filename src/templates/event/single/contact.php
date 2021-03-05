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

$name       = get_the_author_meta( 'display_name', $contact );
$this_title = get_the_author_meta( 'title', $contact );
$email      = get_the_author_meta( 'user_email', $contact );
$phone      = get_the_author_meta( 'phone', $contact );
?>

<section class="fse-event-contact">

	<h2 class="fse-event-aside-heading fse-event-contact-heading"><?php esc_html_e( 'Event Contact', 'full-score-events' ); ?></h2>

	<address class="fse-contact-card">
		<?php echo get_avatar( $contact, 94 ); ?>

		<div class="fse-contact-card-details">
			<strong class="fse-contact-card-name"><?php echo esc_html( $name ); ?></strong>

			<?php if ( $this_title ) : ?>
				<span class="fse-contact-title"><?php echo esc_html( $this_title ); ?></span>
			<?php endif; ?>

			<div class="fse-contact-card-methods">
				<a href="mailto:<?php echo esc_attr( $email ); ?>" class="fse-contact-method fse-contact-email">
					<?php do_icon( 'envelope' ); ?>
					<?php echo esc_html( $email ); ?>
				</a>

				<?php if ( $phone ) : ?>
					<a href="tel:<?php echo esc_attr( $phone ); ?>" class="fse-contact-method fse-contact-phone">
						<?php do_icon( 'phone' ); ?>
						<?php echo esc_html( $phone ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</address>

</section>
