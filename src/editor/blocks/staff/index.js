/**
 * Staff member listing block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { people as icon } from '@wordpress/icons';

const ALLOWED_BLOCKS = [ 'full-score-events/staff-member' ];

const BLOCKS_TEMPLATE = [
	[ 'full-score-events/staff-member' ],
	[ 'full-score-events/staff-member' ],
	[ 'full-score-events/staff-member' ],
];

registerBlockType( 'full-score-events/staff', {
	apiVersion: 2,
	title: __( 'Staff', 'full-score-events' ),
	description: __( 'Staff member listing.', 'full-score-events' ),
	icon,
	category: 'fse-event',
	keywords: [ __( 'staff' ), __( 'faculty' ), __( 'team' ) ],

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
