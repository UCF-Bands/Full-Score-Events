/**
 * Staff member block
 *
 * Allows editor to display a staff member by staff post.
 *
 * @since 1.0.0
 */

import './style.scss';
import './index.scss';

import PostSelectWrapper from '../../components/post-select-wrapper';

import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';
import { registerBlockType } from '@wordpress/blocks';
import { people as icon } from '@wordpress/icons';

const config = {
	apiVersion: 2,
	title: __( 'Staff Member', 'full-score-events' ),
	icon,
	category: 'fse-event',
	keywords: [ __( 'staff member' ), __( 'faculty member' ), __( 'team' ) ],
	parent: [ 'full-score-events/staff' ],

	edit: ( { attributes } ) => {
		const { selectedPost } = attributes;

		return selectedPost.value ? (
			<ServerSideRender
				block="full-score-events/staff-member"
				attributes={ attributes }
			/>
		) : (
			<p>
				{ __(
					'Please select a staff member in block options',
					'full-score-events'
				) }
			</p>
		);
	},

	save: () => null,

	// for PostSelectWrapper
	postType: 'fse_staff',
	selectLabel: __( 'staff member', 'full-score-events' ),
};

/**
 * Register staff member block
 *
 * {@link https://wordpress.org/gutenberg/handbook/block-api/}
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully registered; otherwise `undefined`.
 */
registerBlockType(
	'full-score-events/staff-member',
	PostSelectWrapper( config )
);
