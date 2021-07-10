/**
 * Event visibility/featured handling sidebar plugin
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
	limitToEnsembles: {
		key: '_limit_to_ensembles',
		type: 'boolean',
	},
} )(
	( {
		postType,
		isFeatured,
		setIsFeatured,
		limitToEnsembles,
		setLimitToEnsembles,
	} ) => {
		if ( postType !== 'fse_event' ) {
			return null;
		}

		return (
			<>
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
				<PluginPostStatusInfo>
					<ToggleControl
						label={ __(
							"Limit to Ensembles' Views",
							'full-score-events'
						) }
						help={ __(
							"Only show this event in views filtered to this event's ensemble(s).",
							'full-score-events'
						) }
						checked={ limitToEnsembles }
						onChange={ ( value ) => setLimitToEnsembles( value ) }
					/>
				</PluginPostStatusInfo>
			</>
		);
	}
);

// register the sidebar plugin
registerPlugin( 'fse-event-visibility', { render, icon: 'tickets-alt' } );
