/**
 * Event location/contact settings
 *
 * @see   https://github.com/WordPress/gutenberg/blob/c88866cd91ea3eb7990a68978e03e2366ed7106c/packages/editor/src/components/post-author/index.js
 * @since 1.0.0
 */

import AsyncSelect from 'react-select/async';

import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { BaseControl, Button } from '@wordpress/components';

import pluginMetaHandler from '../../util/plugin-meta-handler';
import getApiOptions from '../../util/get-api-options';

import ContactControl from './contact-control';

const render = pluginMetaHandler( {
	location: {
		key: '_location_id',
		type: 'postId',
	},
	contact: {
		key: '_contact_id',
		type: 'userId',
	},
} )(
	( {
		postType,
		location,
		locationPost,
		contact,
		contactUsers,
		contactIsRequesting,
		setLocation,
		setContact,
	} ) => {
		// sanity check for event
		if ( postType !== 'fse_event' ) {
			return null;
		}

		// location post select control
		const locationControl = (
			<BaseControl
				id="fse-location-select"
				label={ __( 'Location', 'full-score-events' ) }
			>
				<AsyncSelect
					name="kb-post-select"
					value={
						locationPost
							? {
									label: locationPost.title.rendered,
									value: location,
							  }
							: {}
					}
					onChange={ ( option ) => setLocation( option.value ) }
					loadOptions={ ( inputValue, callback ) =>
						getApiOptions( 'fse_location', inputValue, callback )
					}
					placeholder={ __(
						'Start typing location name',
						'full-score-events'
					) }
					noOptionsMessage={ () =>
						__(
							'No options. Start typing location name',
							'full-score-events'
						)
					}
				/>
				{ locationPost && (
					<Button
						isLink
						isDestructive
						onClick={ () => setLocation( 0 ) }
					>
						{ __( 'Remove', 'full-score-events' ) }
					</Button>
				) }
			</BaseControl>
		);

		return (
			<PluginDocumentSettingPanel
				className="fse-event-location-contact"
				title={ __( 'Location & Contact', 'full-score-events' ) }
			>
				{ locationControl }
				<ContactControl
					contact={ contact }
					contactUsers={ contactUsers }
					contactIsRequesting={ contactIsRequesting }
					setContact={ setContact }
				/>
			</PluginDocumentSettingPanel>
		);
	}
);

// register the sidebar plugin
registerPlugin( 'fse-event-location-contact', { render, icon: 'location' } );
