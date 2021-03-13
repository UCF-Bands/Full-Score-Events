/**
 * Location block
 *
 * Allows editor to display a location and/or map by location post.
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { mapMarker as icon } from '@wordpress/icons';

import PostSelectWrapper from '../../components/post-select-wrapper';

import './style.scss';

import edit from './edit';

const config = {
	apiVersion: 2,
	title: __( 'Location', 'full-score-events' ),
	description: __(
		'Display an event location/venue address and/or map embed',
		'full-score-events'
	),
	icon,
	category: 'fse-event',
	keywords: [ __( 'location' ), __( 'address' ), __( 'venue' ) ],

	attributes: {
		showAddress: {
			type: 'boolean',
			default: false,
		},
		showMap: {
			type: 'boolean',
			default: true,
		},
	},

	edit,
	save: () => null,

	// for PostSelectWrapper
	postType: 'fse_location',
	selectLabel: __( 'location', 'full-score-events' ),
};

/**
 * Register location block
 *
 * {@link https://wordpress.org/gutenberg/handbook/block-api/}
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully registered; otherwise `undefined`.
 */
registerBlockType( 'full-score-events/location', PostSelectWrapper( config ) );
