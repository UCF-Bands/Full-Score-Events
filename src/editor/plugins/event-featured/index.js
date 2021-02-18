/**
 * Featured event handling sidebar plugin
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { ToggleControl } from '@wordpress/components';

import pluginMetaHandler from '../../util/plugin-meta-handler';

const render = pluginMetaHandler( {
	isFeatured: {
		key: '_is_featured',
		type: 'boolean',
	},
} )( ( { postType, isFeatured, setIsFeatured } ) => {
	if ( postType !== 'fse_event' ) {
		return null;
	}

	return (
		<PluginPostStatusInfo>
			<ToggleControl
				label={ __( 'Featured Event', 'full-score-events' ) }
				help={ __(
					'Feature this event on the events page.',
					'full-score-events'
				) }
				checked={ isFeatured }
				onChange={ ( value ) => setIsFeatured( value ) }
			/>
		</PluginPostStatusInfo>
	);
} );

// register the sidebar plugin
registerPlugin( 'fse-event-featured', { render, icon: 'tickets-alt' } );
