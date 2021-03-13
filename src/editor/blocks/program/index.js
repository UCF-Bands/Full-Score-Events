/**
 * Program block
 *
 * Allows editor to display a program by program post.
 *
 * @since 1.0.0
 */

import './style.scss';
import './index.scss';

import PostSelectWrapper from '../../components/post-select-wrapper';

import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';
import { registerBlockType } from '@wordpress/blocks';
import { formatListBullets as icon } from '@wordpress/icons';

const config = {
	apiVersion: 2,
	title: __( 'Program', 'full-score-events' ),
	description: __(
		'Display a concert/performance program',
		'full-score-events'
	),
	icon,
	category: 'fse-event',
	keywords: [ __( 'program' ), __( 'concert' ), __( 'ensemble' ) ],

	edit: ( { attributes } ) => {
		const { selectedPost } = attributes;

		return selectedPost.value ? (
			<ServerSideRender
				block="full-score-events/program"
				attributes={ attributes }
			/>
		) : (
			<p>
				{ __(
					'Please select a program in block options',
					'full-score-events'
				) }
			</p>
		);
	},

	save: () => null,

	// for PostSelectWrapper
	postType: 'fse_program',
	selectLabel: __( 'program', 'full-score-events' ),
};

/**
 * Register program block
 *
 * {@link https://wordpress.org/gutenberg/handbook/block-api/}
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully registered; otherwise `undefined`.
 */
registerBlockType( 'full-score-events/program', PostSelectWrapper( config ) );
