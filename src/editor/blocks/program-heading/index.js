/**
 * Program heading block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { heading as icon } from '@wordpress/icons';

// import './style.scss';

import edit from './edit';
import save from './save';

registerBlockType( 'full-score-events/program-heading', {
	apiVersion: 2,
	title: __( 'Program Heading', 'full-score-events' ),
	description: __(
		'Heading for an emsemble + notes in a program',
		'full-score-events'
	),
	icon,
	keywords: [ __( 'program' ), __( 'heading' ), __( 'message' ) ],
	parent: [ 'full-score-events/program-edit' ],

	attributes: {
		heading: {
			type: 'string',
			source: 'html', // @todo change these to text?
			selector: '.fse-program-heading-heading',
		},
		subheading: {
			type: 'string',
			source: 'html',
			selector: '.fse-program-subheading',
		},
		tertiaryHeading: {
			type: 'string',
			source: 'html',
			selector: '.fse-program-tertiary-heading',
		},
	},

	edit,
	save,
} );
