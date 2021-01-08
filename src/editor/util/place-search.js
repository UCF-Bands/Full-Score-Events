/**
 * Google place search
 *
 * @see     https://github.com/davilera/nelio-maps
 * @since   1.0.0
 */

import { withScriptjs } from 'react-google-maps';
import { compose, withState, withProps, withHandlers } from 'recompose';

import { TextControl } from '@wordpress/components';

const {
	StandaloneSearchBox,
} = require( 'react-google-maps/lib/components/places/StandaloneSearchBox' );

const PlaceSearch = compose(
	withState( 'value', 'setValue', ( props ) => {
		return props.value;
	} ),

	withProps( {
		loadingElement: <div />,
		containerElement: <div />,
	} ),

	withHandlers( () => {
		const refs = {
			searchBox: undefined,
		};

		return {
			onSearchBoxMounted: () => ( ref ) => {
				refs.searchBox = ref;
			},

			onPlacesChanged: ( props ) => () => {
				const places = refs.searchBox.getPlaces();

				if ( ! props.onChange || ! places || ! places[ 0 ] ) {
					return;
				}

				const place = places[ 0 ];

				/* eslint-disable camelcase */
				const {
					name,
					place_id,
					adr_address,
					formatted_address,
					url,
				} = place;
				const { location } = place.geometry;

				props.onChange(
					`${ name }`,
					`${ place_id }`,
					`${ adr_address }`,
					`${ formatted_address }`,
					`${ url }`,
					`${ location.lat() }`,
					`${ location.lng() }`
				);
				props.setValue( formatted_address );
				/* eslint-enable camelcase */
			},
		};
	} ),

	withScriptjs
)( ( props ) => {
	const {
		bounds,
		className,
		label,
		onPlacesChanged,
		onSearchBoxMounted,
		placeholder,
		setValue,
		value,
	} = props;

	return (
		<div data-standalone-searchbox="" className={ className }>
			<StandaloneSearchBox
				ref={ onSearchBoxMounted }
				bounds={ bounds }
				onPlacesChanged={ onPlacesChanged }
			>
				<TextControl
					label={ label }
					placeholder={ placeholder }
					value={ value }
					onChange={ ( newValue ) => setValue( newValue ) }
				/>
			</StandaloneSearchBox>
		</div>
	);
} );

export default PlaceSearch;
