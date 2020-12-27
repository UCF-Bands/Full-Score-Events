/**
 * Schedule block
 *
 * Allows editor to display a schedule by schedule post.
 *
 * @since 1.0.0
 */

// import './style.css';
// import './editor.css';

import PostSelectWrapper from '../../components/post-select-wrapper';

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { formatListBullets as icon } from '@wordpress/icons';

import edit from './edit';

const config = {
	apiVersion: 2,
	title: __( 'Schedule', 'full-score-events' ),
	description: __(
		"Display a schedule's activities and download",
		'full-score-events'
	),
	icon,
	category: 'design',
	keywords: [ __( 'schedule' ), __( 'activites' ), __( 'event' ) ],

	attributes: {
		showTitle: {
			type: 'boolean',
			default: false,
		},
	},

	edit,
	save: () => null,

	// for PostSelectWrapper
	postType: 'fse_schedule',
	selectLabel: __( 'schedule', 'full-score-events' ),
};

/**
 * Register schedule block
 *
 * {@link https://wordpress.org/gutenberg/handbook/block-api/}
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully registered; otherwise `undefined`.
 */
registerBlockType( 'full-score-events/schedule', PostSelectWrapper( config ) );
