/**
 * Next event block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { calendar as icon } from '@wordpress/icons';

import EnsemblesSelectWrapper from '../../components/ensembles-select-wrapper';

// import './style.scss';
// import './index.scss';

import edit from './edit';

const config = {
	apiVersion: 2,
	title: __( 'Next Event', 'full-score-events' ),
	description: __(
		'Show brief details about an ensemble(s) next event.',
		'full-score-events'
	),
	icon,
	category: 'fse-event',
	keywords: [ __( 'upcoming' ), __( 'next event' ), __( 'performance' ) ],

	attributes: {
		heading: {
			type: 'string',
			default: __( 'Next Event', 'full-score-events' ),
		},
	},

	edit,
	save: () => null,
};

registerBlockType(
	'full-score-events/next-event',
	EnsemblesSelectWrapper( config )
);
