/**
 * Individual schedule item block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { formatListBullets as icon } from '@wordpress/icons';

// import './style.css';
// import './index.css';

import edit from './edit';

registerBlockType( 'full-score-events/schedule-item', {
	apiVersion: 2,
	title: __( 'Schedule Item', 'full-score-events' ),
	description: __( "Edit a schedule's schedule.", 'full-score-events' ),
	icon,
	keywords: [ __( 'schedule' ), __( 'plan' ) ],
	parent: [ 'full-score-events/schedule-items' ],

	attributes: {
		dateTime: {
			type: 'string',
			default: '',
		},
		activity: {
			type: 'string',
			default: '',
		},
	},

	edit,
	save: () => null,
} );
