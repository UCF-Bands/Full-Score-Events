/**
 * Program piece block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { formatListBullets as icon } from '@wordpress/icons';

import './style.scss';

import edit from './edit';
import save from './save';

registerBlockType( 'full-score-events/program-piece', {
	apiVersion: 2,
	title: __( 'Piece', 'full-score-events' ),
	description: __( 'A piece of music in a program', 'full-score-events' ),
	icon,
	keywords: [ __( 'program' ), __( 'piece' ), __( 'song' ) ],
	category: 'fse-event',
	parent: [ 'full-score-events/program-pieces' ],

	attributes: {
		title: {
			type: 'string',
			source: 'html',
			selector: '.fse-piece-title',
		},
		note: {
			type: 'string',
			source: 'html',
			selector: '.fse-piece-note',
		},
		composer: {
			type: 'string',
			source: 'html',
			selector: '.fse-piece-composer-name',
		},
		arranger: {
			type: 'string',
			source: 'html',
			selector: '.fse-piece-arranger-name',
		},
	},

	edit,
	save,
} );
