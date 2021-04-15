/**
 * Event location/contact settings
 *
 * @since 1.0.0
 * @see   https://github.com/WordPress/gutenberg/blob/c88866cd91ea3eb7990a68978e03e2366ed7106c/packages/editor/src/components/post-author/index.js
 */

import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';

import pluginMetaHandler from '../../util/plugin-meta-handler';

import PostSelectControl from '../../components/post-select-control';

const render = pluginMetaHandler( {
	location: {
		key: '_location_id',
		type: 'postId',
		postType: 'fse_location',
	},
	contact: {
		key: '_contact_id',
		type: 'postId',
		postType: 'fse_staff',
	},
} )(
	( {
		postType,
		location,
		locationPost,
		contact,
		contactPost,
		setLocation,
		setContact,
	} ) => {
		// sanity check for event
		if ( postType !== 'fse_event' ) {
			return null;
		}

		return (
			<PluginDocumentSettingPanel
				className="fse-event-location-contact"
				title={ __( 'Location & Contact', 'full-score-events' ) }
			>
				<PostSelectControl
					label={ __( 'Location', 'full-score-events' ) }
					selectLabel={ __( 'location', 'full-score-events' ) }
					postType="fse_location"
					postId={ location }
					post={ locationPost }
					setPostId={ setLocation }
				/>
				<PostSelectControl
					label={ __( 'Primary Contact', 'full-score-events' ) }
					selectLabel={ __( 'staff member', 'full-score-events' ) }
					postType="fse_staff"
					postId={ contact }
					post={ contactPost }
					setPostId={ setContact }
				/>
			</PluginDocumentSettingPanel>
		);
	}
);

// register the sidebar plugin
registerPlugin( 'fse-event-location-contact', { render, icon: 'location' } );
