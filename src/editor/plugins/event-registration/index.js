/**
 * Event registration settings
 *
 * @since 1.0.0
 */

import find from 'lodash/find';

import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { URLInput } from '@wordpress/block-editor';
import { TextControl, RadioControl } from '@wordpress/components';

import './index.scss';

const render = compose(
	/*
	 * withSelect allows us to get existing meta values
	 */
	withSelect( ( select ) => {
		const meta = Object.assign(
			{},
			select( 'core/editor' ).getEditedPostAttribute( 'meta' )
		);

		return {
			postType: select( 'core/editor' ).getCurrentPostType(),
			type: meta._registration_type,
			url: meta._registration_url,
			price: meta._price,
		};
	} ),

	/*
	 * withDispatch allows us to save meta values
	 */
	withDispatch( ( dispatch ) => {
		const setMeta = ( key, value ) => {
			const meta = {};
			meta[ key ] = value;
			dispatch( 'core/editor' ).editPost( { meta } );
		};

		return {
			setType: ( value ) => setMeta( '_registration_type', value ),
			setUrl: ( value ) => setMeta( '_registration_url', value ),
			setPrice: ( value ) => setMeta( '_price', Number( value ) ),
		};
	} )
)( ( { postType, type, url, price, setType, setUrl, setPrice } ) => {
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
