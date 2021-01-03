/**
 * Program pieces block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { formatListBullets as icon } from '@wordpress/icons';

// import './style.scss';

const ALLOWED_BLOCKS = [ 'full-score-events/program-piece' ];

const BLOCKS_TEMPLATE = [
	[
		'full-score-events/program-piece',
		{
			title: __( 'Big Noise from Winnetka', 'full-score-events' ),
			note: __( 'Ft. UCF Marching Knights', 'full-score-events' ),
			composer: __( 'Bob Haggart', 'full-score-events' ),
			arranger: __( 'Dave Schreier', 'full-score-events' ),
		},
	],
	[
		'full-score-events/program-piece',
		{
			title: __( 'Entry of Pegasus', 'full-score-events' ),
			note: __( 'Max Glorit, Conductor', 'full-score-events' ),
			composer: __( 'Larry Clark', 'full-score-events' ),
		},
	],
];

registerBlockType( 'full-score-events/program-pieces', {
	apiVersion: 2,
	title: __( 'Pieces', 'full-score-events' ),
	description: __( "Edit a program's pieces.", 'full-score-events' ),
	icon,
	keywords: [ __( 'program' ), __( 'pieces' ), __( 'songs' ) ],
	parent: [ 'full-score-events/program-edit' ],

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
