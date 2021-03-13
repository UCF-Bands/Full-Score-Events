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

const ALLOWED_BLOCKS = [
	'full-score-events/program-heading',
	'full-score-events/program-pieces',
];

const BLOCKS_TEMPLATE = [
	[
		'full-score-events/program-heading',
		{
			heading: __( 'UCF Symphonic Band', 'full-score-events' ),
			subheading: __( 'Dr. Tremon Kizer, Director', 'full-score-events' ),
			tertiaryHeading: __(
				'Danny Santos, GTA Conductor',
				'full-score-events'
			),
		},
	],
	[ 'full-score-events/program-pieces' ],
	[
		'full-score-events/program-heading',
		{
			heading: __( 'UCF Wind Ensemble', 'full-score-events' ),
			subheading: __(
				'Dr. Scott Lubaroff, Director',
				'full-score-events'
			),
		},
	],
	[ 'full-score-events/program-pieces' ],
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
		category: 'fse-event',
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
