<?php
/**
 * Program block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

global $fse_program;

$edit_block = $fse_program->get_edit_block();

if ( ! $edit_block ) {
	return;
}
?>

<div <?php do_attrs_class( 'fse-program', $className ?? '' ); ?>>

	<?php
	foreach ( $edit_block['innerBlocks'] as $block ) :
		if ( 'full-score-events/program-pieces' === $block['blockName'] ) :

			if ( ! $block['innerBlocks'] ) {
				continue;
			}
			?>
			<ul class="fse-program-pieces">
				<?php echo implode( '', array_map( 'render_block', $block['innerBlocks'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</ul>
			<?php
		else :
			echo render_block( $block ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;

	endforeach;
	?>
</div>
