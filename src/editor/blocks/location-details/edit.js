/**
 * Location details block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

import PlaceSearch from '../../util/place-search';

const { googleAPIKey, googleMapsURL } = fullScoreEventsEditor;

export default function edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps(),
		{ placeName, address, addressHTML, mapUrl } = attributes;

	return (
		<div { ...blockProps }>
			<h2>{ __( 'Location Details', 'full-score-events' ) }</h2>

			<PlaceSearch
				googleMapURL={ `${ googleMapsURL }&key=${ googleAPIKey }` }
				placeholder={
					address
						? __(
								'Search to set new location',
								'full-score-events'
						  )
						: __( 'Search to set location', 'full-score-events' )
				}
				onChange={ (
					name,
					id,
					addrHTML,
					addrFormatted,
					url,
					lat,
					lng
				) => {
					setAttributes( {
						placeName: name,
						placeId: id,
						addressHTML: addrHTML,
						address: addrFormatted,
						mapUrl: url,
						mapMarker: { lat, lng },
					} );
				} }
			/>

			<address className="address-full">
				<strong>{ placeName }</strong>
				<br />
				<span
					dangerouslySetInnerHTML={ { __html: addressHTML } }
				></span>
			</address>

			{ mapUrl && (
				<a href={ mapUrl } target="_blank" rel="noopener noreferrer">
					{ __( 'Google Map', 'full-score-events' ) }
				</a>
			) }
		</div>
	);
}
