/**
 * Event registration settings
 *
 * @since 1.0.0
 */

import find from 'lodash/find';

import { __, sprintf } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { URLInput } from '@wordpress/block-editor';
import {
	TextControl,
	SelectControl,
	ToggleControl,
} from '@wordpress/components';

import pluginMetaHandler from '../../util/plugin-meta-handler';

import './index.scss';

const render = pluginMetaHandler( {
	type: {
		key: '_registration_type',
	},
	typeLabel: {
		key: '_registration_label',
	},
	url: {
		key: '_registration_url',
	},
	price: {
		key: '_price',
		type: 'number',
	},
	showPrice: {
		key: '_show_price',
		type: 'boolean',
	},
} )(
	( {
		postType,
		type,
		typeLabel,
		url,
		price,
		showPrice,
		setType,
		setTypeLabel,
		setUrl,
		setPrice,
		setShowPrice,
	} ) => {
		// sanity check for event
		if ( postType !== 'fse_event' ) {
			return null;
		}

		const types = [
			{
				label: __( 'None', 'full-score-events' ),
				value: '',
				urlLabel: false,
			},
			{
				label: __( 'Registration', 'full-score-events' ),
				value: 'register',
				typeLabel: __( 'Register', 'full-score-events' ),
				urlLabel: __( 'Registration Link', 'full-score-events' ),
			},
			{
				label: __( 'Tickets', 'full-score-events' ),
				value: 'ticket',
				typeLabel: __( 'Get Tickets', 'full-score-events' ),
				urlLabel: __( 'Tickets Link', 'full-score-events' ),
			},
		];

		const typeData = find( types, [ 'value', type ] );

		return (
			<PluginDocumentSettingPanel
				className="fse-event-registration"
				title={ __( 'Tickets/Registration', 'full-score-events' ) }
			>
				<SelectControl
					className="fse-event-registration-type"
					label={ __( 'Type', 'full-score-events' ) }
					options={ types }
					onChange={ ( value ) => setType( value ) }
					value={ type }
				/>

				{ type && (
					<TextControl
						label={ __( 'Button Text', 'full-score-events' ) }
						placeholder={ sprintf(
							// Translators: Defaults to %s (registration type label)
							__( 'Defaults to "%s"', 'full-score-events' ),
							typeData.typeLabel
						) }
						value={ typeLabel }
						onChange={ ( value ) => setTypeLabel( value ) }
					/>
				) }

				{ typeData.urlLabel && (
					<URLInput
						label={ typeData.urlLabel }
						value={ url }
						onChange={ ( value ) => setUrl( value ) }
					/>
				) }

				<ToggleControl
					label={ __( 'Show Price', 'full-score-events' ) }
					checked={ showPrice }
					onChange={ ( value ) => setShowPrice( value ) }
				/>

				{ showPrice && (
					<TextControl
						label={ __( 'Price ($)', 'full-score-events' ) }
						type="number"
						min={ 0 }
						step={ 0.01 }
						value={ price }
						onChange={ setPrice }
					/>
				) }
			</PluginDocumentSettingPanel>
		);
	}
);

// register the sidebar plugin
registerPlugin( 'fse-event-registration', { render, icon: 'tickets-alt' } );
