/**
 * Schedule items block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
import { formatListBullets as icon } from '@wordpress/icons';

import './index.scss';

import edit from './edit';

// only allow schedule editing in schedule CPT
if ( fullScoreEventsEditor.currentCPT === 'fse_schedule' ) {
	registerBlockType( 'full-score-events/schedule-items', {
		apiVersion: 2,
		title: __( 'Schedule Items', 'full-score-events' ),
		description: __( "Edit a schedule's schedule.", 'full-score-events' ),
		icon,
		keywords: [ __( 'schedule' ), __( 'plan' ) ],

		attributes: {
			uploadId: {
				type: 'number',
			},
			uploadHref: {
				type: 'string',
			},
		},

		edit,
		save: () => <InnerBlocks.Content />,
	} );
}
