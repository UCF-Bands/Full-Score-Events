/**
 * Location block
 *
 * Allows editor to display a location and/or map by location post.
 *
 * @since 1.0.0
 */

// import './style.scss';
// import './index.scss';

import PostSelectWrapper from '../../components/post-select-wrapper';

import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';
import { registerBlockType } from '@wordpress/blocks';
import { mapMarker as icon } from '@wordpress/icons';

const config = {
	apiVersion: 2,
	title: __( 'Location', 'full-score-events' ),
	description: __(
		'Display an event location/venue address and/or map embed',
		'full-score-events'
	),
	icon,
	category: 'common', // @todo audit all categories
	keywords: [ __( 'location' ), __( 'address' ), __( 'venue' ) ],

	edit: ( { attributes } ) => {
		const { selectedPost } = attributes;

		return selectedPost.value ? (
			<ServerSideRender
				block="full-score-events/location"
				attributes={ attributes }
			/>
		) : (
			<p>
				{ __(
					'Please select a location in block options',
					'full-score-events'
				) }
			</p>
		);
	},

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
