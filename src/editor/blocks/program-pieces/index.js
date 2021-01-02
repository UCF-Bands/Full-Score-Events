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
	[ 'full-score-events/program-piece' ],
	[ 'full-score-events/program-piece' ],
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
