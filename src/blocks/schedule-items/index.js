/**
 * Schedule items block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { formatListBullets as icon } from '@wordpress/icons';

// import './style.css';
// import './index.css';

const ALLOWED_BLOCKS = [ 'full-score-events/schedule-item' ];

// only allow schedule editing in schedule CPT
if ( fullScoreEventsEditor.currentCPT === 'fse_schedule' ) {
	registerBlockType( 'full-score-events/schedule-items', {
		apiVersion: 2,
		title: __( 'Schedule Items', 'full-score-events' ),
		description: __( "Edit a schedule's schedule.", 'full-score-events' ),
		icon,
		keywords: [ __( 'schedule' ), __( 'plan' ) ],

		edit() {
			const blockProps = useBlockProps();

			return (
				<div { ...blockProps }>
					<InnerBlocks allowedBlocks={ ALLOWED_BLOCKS } />
				</div>
			);
		},

		save() {
			const blockProps = useBlockProps.save();

			return (
				<div { ...blockProps }>
					<InnerBlocks.Content />
				</div>
			);
		},
	} );
}
