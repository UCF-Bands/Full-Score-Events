<?php
/**
 * Location block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

global $fse_staff_member;

?>

<figure <?php do_attrs_class( 'fse-staff-card', $className ?? '' ); ?>>

	<div class="fse-staff-card-thumbnail-wrap">
		<?php the_post_thumbnail( 'medium_large' ); ?>
	</div>

	<figcaption class="fse-staff-card-content-wrap">

		<div class="fse-staff-card-content">
			<?php the_title( '<h4 class="fse-staff-card-name">', '</h4>' ); ?>
			<p class="fse-staff-card-position"><?php $fse_staff_member->do_position(); ?></p>
		</div>

		<ul class="fse-staff-card-icons">
			<?php if ( $fse_staff_member->get_post()->post_content ) : ?>
				<li class="fse-staff-card-icon fse-staff-card-content-icon">
					<span class="screen-reader-text"><?php esc_attr_e( 'Staff member has bio', 'full-score-events' ); ?></span>
					<?php do_icon( 'id-card-solid' ); ?>
				</li>
			<?php endif; ?>

			<?php if ( $fse_staff_member->get_email() ) : ?>
				<li class="fse-staff-card-icon fse-staff-card-email-icon">
					<span class="screen-reader-text"><?php esc_attr_e( 'Staff member has email address', 'full-score-events' ); ?></span>
					<?php do_icon( 'envelope-solid' ); ?>
				</li>
			<?php endif; ?>

			<?php if ( $fse_staff_member->get_phone() ) : ?>
				<li class="fse-staff-card-icon fse-staff-card-phone-icon">
					<span class="screen-reader-text"><?php esc_attr_e( 'Staff member has phone number', 'full-score-events' ); ?></span>
					<?php do_icon( 'phone-solid' ); ?>
				</li>
			<?php endif; ?>
		</ul>

	</figcaption>

	<a href="<?php the_permalink(); ?>" class="fse-link-overlay">
		<span class="screen-reader-text"><?php esc_html_e( 'Read more about', 'full-score-events' ); ?> <?php the_title(); ?></span>
	</a>

</figure>
