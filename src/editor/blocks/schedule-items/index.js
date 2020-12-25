/**
 * Schedule items block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { formatListBullets as icon } from '@wordpress/icons';

const ALLOWED_BLOCKS = [ 'full-score-events/schedule-item' ];

const BLOCKS_TEMPLATE = [
	[ 'full-score-events/schedule-item' ],
	[ 'full-score-events/schedule-item' ],
];

registerBlockType( 'full-score-events/schedule-items', {
	apiVersion: 2,
	title: __( 'Schedule Items', 'full-score-events' ),
	description: __( "Edit a schedule's activities.", 'full-score-events' ),
	icon,
	keywords: [ __( 'schedule' ), __( 'plan' ) ],
	parent: [ 'full-score-events/schedule-edit' ],

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
