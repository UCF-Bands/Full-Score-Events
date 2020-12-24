/**
 * Callout block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { info as icon } from '@wordpress/icons';

// import './index.scss';

import edit from './edit';
import save from './save';

registerBlockType( 'full-score-events/callout', {
	apiVersion: 2,
	title: __( 'Callout', 'full-score-events' ),
	description: __( 'Display a notice or warning.', 'full-score-events' ),
	icon,
	keywords: [ __( 'schedule' ), __( 'notice' ), __( 'message' ) ],

	attributes: {
		type: {
			type: 'string',
			default: 'info',
		},
		message: {
			type: 'string',
			source: 'html',
			selector: '.fse-callout-message',
		},
	},

	edit,
	save,
} );
