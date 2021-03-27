/**
 * Upcoming events block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { calendar as icon } from '@wordpress/icons';

import './style.scss';
import './index.scss';

import edit from './edit';

registerBlockType( 'full-score-events/upcoming-events', {
	apiVersion: 2,
	title: __( 'Upcoming Events', 'full-score-events' ),
	description: __(
		'A listing of the next events to take place',
		'full-score-events'
	),
	icon,
	category: 'fse-event',
	keywords: [ __( 'upcoming' ), __( 'next events' ), __( 'event list' ) ],

	supports: {
		align: [ 'wide' ],
	},

	attributes: {
		align: {
			type: 'string',
			default: '',
		},

		number: {
			type: 'number',
			default: 3,
		},

		noneFound: {
			type: 'string',
			default: __(
				"There aren't any scheduled events at this time.",
				'full-score-events'
			),
		},

		ensembles: {
			type: 'array',
			default: [],
		},
	},

	edit,
	save: () => null,
} );
