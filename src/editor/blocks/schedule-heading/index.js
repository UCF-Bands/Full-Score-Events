/**
 * Schedule heading block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { heading as icon } from '@wordpress/icons';

import './style.scss';

import edit from './edit';
import save from './save';

registerBlockType( 'full-score-events/schedule-heading', {
	apiVersion: 2,
	title: __( 'Schedule Heading', 'full-score-events' ),
	description: __(
		'Heading for a schedule or day in the schedule',
		'full-score-events'
	),
	icon,
	category: 'fse-event',
	keywords: [ __( 'schedule' ), __( 'heading' ), __( 'message' ) ],
	parent: [ 'full-score-events/schedule-edit' ],

	attributes: {
		heading: {
			type: 'string',
			source: 'html',
			selector: '.fse-schedule-heading-heading',
		},
	},

	edit,
	save,
} );
