/**
 * Individual schedule item block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
import { formatListBullets as icon } from '@wordpress/icons';

import './style.scss';
import './index.scss';

import edit from './edit';

registerBlockType( 'full-score-events/schedule-item', {
	apiVersion: 2,
	title: __( 'Schedule Item', 'full-score-events' ),
	description: __( "Edit a schedule's schedule.", 'full-score-events' ),
	icon,
	category: 'fse-event',
	keywords: [ __( 'schedule' ), __( 'plan' ) ],
	parent: [ 'full-score-events/schedule-items' ],

	attributes: {
		dateTime: {
			type: 'string',
			default: '', // @todo is this necessary?
		},
	},

	edit,
	save: () => <InnerBlocks.Content />,
} );
