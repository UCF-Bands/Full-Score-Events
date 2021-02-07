/**
 * Upcoming events block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { calendar as icon } from '@wordpress/icons';

// import './style.scss';

import edit from './edit';

registerBlockType( 'full-score-events/upcoming-events', {
	apiVersion: 2,
	title: __( 'Upcoming Events', 'full-score-events' ),
	description: __(
		'A listing of the next events to take place',
		'full-score-events'
	),
	icon,
	keywords: [ __( 'upcoming' ), __( 'next events' ), __( 'event list' ) ],

	attributes: {
		number: {
			type: 'number',
		},
	},

	edit,
	save: () => null,
} );
