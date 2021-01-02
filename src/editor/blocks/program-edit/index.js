/**
 * Program editing block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { formatListBullets as icon } from '@wordpress/icons';

// import './index.scss';

// import edit from './edit';

const ALLOWED_BLOCKS = [
	'full-score-events/program-heading',
	'full-score-events/program-pieces',
];

const BLOCKS_TEMPLATE = [
	// [
	// 	'full-score-events/schedule-heading',
	// 	{ heading: __( 'Day 1: Travel', 'full-score-events' ) },
	// 	[
	// 		[
	// 			'full-score-events/callout',
	// 			{
	// 				type: 'error',
	// 				message: __(
	// 					'This is a warning message you can use or delete.',
	// 					'full-score-events'
	// 				),
	// 			},
	// 		],
	// 	],
	// ],
	// [ 'full-score-events/schedule-items' ],
	// [
	// 	'full-score-events/schedule-heading',
	// 	{ heading: __( 'Day 2: UCF vs NAVY', 'full-score-events' ) },
	// 	[
	// 		[
	// 			'full-score-events/callout',
	// 			{
	// 				type: 'success',
	// 				message: __( 'Gameday!', 'full-score-events' ),
	// 			},
	// 		],
	// 	],
	// ],
	// [ 'full-score-events/schedule-items' ],
];

// only allow program editing in program CPT
if ( fullScoreEventsEditor.currentCPT === 'fse_program' ) {
	registerBlockType( 'full-score-events/program-edit', {
		apiVersion: 2,
		title: __( 'Program Editor', 'full-score-events' ),
		description: __(
			"Edit a program's pieces/ensembles/notes.",
			'full-score-events'
		),
		icon,
		keywords: [ __( 'program' ), __( 'concert' ), __( 'ensemble' ) ],

		edit: () => (
			<div { ...useBlockProps() }>
				<InnerBlocks
					allowedBlocks={ ALLOWED_BLOCKS }
					template={ BLOCKS_TEMPLATE }
				/>
			</div>
		),

		save: () => <InnerBlocks.Content />,
	} );
}
