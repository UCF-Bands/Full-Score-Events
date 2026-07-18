<?php
/**
 * Template for displaying a staff member's contacts.
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/staff/contacts.php
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

/**
 * Global staff member.
 *
 * @var \Full_Score_Events\Staff_Member $fse_staff_member
 */
global $fse_staff_member;

$email    = $fse_staff_member->get_email();
$phone    = $fse_staff_member->get_phone();
$facebook = $fse_staff_member->get_facebook_url();
$discord  = $fse_staff_member->get_discord_url();

if ( ! $email && ! $phone && ! $facebook && ! $discord ) {
	return;
}
?>

<address class="fse-staff-contacts">
	<?php if ( $email ) : ?>
		<a href="mailto:<?php echo esc_attr( $email ); ?>" class="fse-contact-method fse-contact-email">
			<?php do_icon( 'envelope' ); ?>
			<?php echo esc_html( $email ); ?>
		</a>
	<?php endif; ?>

	<?php if ( $phone ) : ?>
		<a href="tel:<?php echo esc_attr( $phone ); ?>" class="fse-contact-method fse-contact-phone">
			<?php do_icon( 'phone' ); ?>
			<?php echo esc_html( $fse_staff_member->get_phone_display() ?: $phone ); ?>
		</a>
	<?php endif; ?>

	<?php if ( $facebook ) : ?>
		<a href="<?php echo esc_url( $facebook ); ?>" class="fse-contact-method fse-contact-facebook">
			<?php do_icon( 'facebook' ); ?>
			<?php echo esc_html( $fse_staff_member->get_facebook_label() ) ?: esc_html_e( 'Facebook', 'full-score-events' ); ?>
		</a>
	<?php endif; ?>

	<?php if ( $discord ) : ?>
		<a href="<?php echo esc_url( $discord ); ?>" class="fse-contact-method fse-contact-discord">
			<?php do_icon( 'discord' ); ?>
			<?php echo esc_html( $fse_staff_member->get_discord_label() ) ?: esc_html_e( 'Discord', 'full-score-events' ); ?>
		</a>
	<?php endif; ?>
</address>
