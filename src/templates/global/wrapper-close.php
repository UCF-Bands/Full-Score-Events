<?php
/**
 * Template for displaying the main content wrapper close
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/global/wrapper-close.php.
 *
 * However, Full Score Events may need to update template files and you (the
 * theme developer) will need to copy the new file to your theme to maintain
 * compatibility. It is recommended that you make your customizations using
 * hooks/filters to reduce technical debt.
 *
 * @see WooCommerce's templates/global/wrapper-end.php
 *
 * @package Full_Score_Events/templates
 * @since   1.0.0
 */

namespace Full_Score_Events;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

switch ( get_option( 'template' ) ) {
	case 'twentytwentyone':
		break;

	default:
		echo '</main>';
		break;
}
