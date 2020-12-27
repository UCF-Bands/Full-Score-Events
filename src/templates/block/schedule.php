<?php
/**
 * Schedule download block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

global $fse_schedule;

$edit_block = $fse_schedule->get_edit_block();

if ( ! $edit_block ) {
	return;
}

$upload_id = $edit_block['attrs']['uploadId'] ?? false;
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

	<?php
	if ( $upload_id ) :
		$a_attrs = apply_filters(
			'full_score_events_schedule_download_attrs',
			[
				'href'     => wp_get_attachment_url( $upload_id ),
				'class'    => 'button',
				'download' => 'download',
			]
		);
		?>
		<a <?php do_attrs( $a_attrs ); ?>>
			<?php
			echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'full_score_events_schedule_download_text',
				__( 'Download', 'full-score-events' ),
				$upload_id
			);
			?>
		</a>
	<?php endif; ?>
</div>
