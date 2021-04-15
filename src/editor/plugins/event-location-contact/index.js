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

import ContactControl from './contact-control';
import LocationControl from './location-control';

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
				<LocationControl
					location={ location }
					locationPost={ locationPost }
					setLocation={ setLocation }
				/>
				<ContactControl
					contact={ contact }
					contactPost={ contactPost }
					setContact={ setContact }
				/>
			</PluginDocumentSettingPanel>
		);
	}
);

// register the sidebar plugin
registerPlugin( 'fse-event-location-contact', { render, icon: 'location' } );
