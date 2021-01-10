/**
 * Event registration settings
 *
 * @since 1.0.0
 */

import find from 'lodash/find';

import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { URLInput } from '@wordpress/block-editor';
import { TextControl, RadioControl } from '@wordpress/components';

import pluginMetaHandler from '../../util/plugin-meta-handler';

import './index.scss';

const render = pluginMetaHandler( {
	type: {
		key: '_registration_type',
	},
	url: {
		key: '_registration_url',
	},
	price: {
		key: '_price',
		type: 'number',
	},
} )( ( { postType, type, url, price, setType, setUrl, setPrice } ) => {
	// sanity check for event
	if ( postType !== 'fse_event' ) {
		return null;
	}

	const types = [
		{
			label: __( 'Registration', 'full-score-events' ),
			value: 'register',
			urlLabel: __( 'Registration Link', 'full-score-events' ),
		},
		{
			label: __( 'Tickets', 'full-score-events' ),
			value: 'ticket',
			urlLabel: __( 'Tickets Link', 'full-score-events' ),
		},
	];

	const typeData = find( types, [ 'value', type ] );

	return (
		<PluginDocumentSettingPanel
			className="fse-event-registration"
			title={ __( 'Tickets/Registration', 'full-score-events' ) }
		>
			<RadioControl
				className="fse-event-registration-type"
				label={ __( 'Type', 'full-score-events' ) }
				options={ types }
				onChange={ ( value ) => setType( value ) }
				selected={ type }
			/>

			<URLInput
				label={ typeData.urlLabel ?? __( 'URL', 'full-score-events' ) }
				value={ url }
				onChange={ ( value ) => setUrl( value ) }
			/>

			<TextControl
				label={ __( 'Price ($)', 'full-score-events' ) }
				type="number"
				min={ 0 }
				step={ 0.01 }
				value={ price }
				onChange={ setPrice }
			/>
		</PluginDocumentSettingPanel>
	);
} );

// register the sidebar plugin
registerPlugin( 'fse-event-registration', { render, icon: 'tickets-alt' } );
