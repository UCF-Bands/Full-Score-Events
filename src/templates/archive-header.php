<?php
/**
 * Template for displaying the events archive header
 *
 * This template can be overridden by copying it to
 * yourtheme/full-score-events/archive-header.php
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

global $post_type;

$post_type_obj = get_post_type_object( $post_type );
?>

<header <?php do_attrs_class( 'fse-archive-header', "{$post_type}-archive-header" ); ?>>

	<h1 <?php do_attrs_class( 'fse-archive-header-title', "{$post_type}-archive-header-title", 'page-title' ); ?>>
		<?php echo esc_html( implode( ' ', [ Ensembles::get_current_terms_list(), $post_type_obj->label ] ) ); ?>
	</h1>

</header>
