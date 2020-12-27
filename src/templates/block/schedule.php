<?php
/**
 * Schedule download block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

global $fse_schedule;

$edit_block = $fse_schedule->get_edit_block();

if ( ! $edit_block ) {
	return;
}

?>

<div class="fse-schedule">
	<?php
	foreach ( $edit_block['innerBlocks'] as $block ) :
		if ( 'full-score-events/schedule-items' === $block['blockName'] && $block['innerBlocks'] ) :
			?>
			<ul class="fse-schedule-items">
				<?php echo implode( '', array_map( 'render_block', $block['innerBlocks'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</ul>
			<?php
		else :
			echo render_block( $block ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;

	endforeach;
	?>
</div>
