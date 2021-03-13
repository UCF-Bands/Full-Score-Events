/**
 * Location details block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { mapMarker as icon } from '@wordpress/icons';

import './index.scss';

import edit from './edit';

// only allow location details in location CPT
if ( fullScoreEventsEditor.currentCPT === 'fse_location' ) {
	registerBlockType( 'full-score-events/location-details', {
		apiVersion: 2,
		title: __( 'Location Details', 'full-score-events' ),
		icon,
		keywords: [ __( 'location' ), __( 'address' ), __( 'venue' ) ],
		category: 'fse-event',

		attributes: {
			placeName: {
				type: 'string',
				source: 'meta',
				meta: '_place_name',
			},
			placeId: {
				type: 'string',
				source: 'meta',
				meta: '_place_id',
			},
			address: {
				type: 'string',
				source: 'meta',
				meta: '_address',
			},
			addressHTML: {
				type: 'string',
				source: 'meta',
				meta: '_address_html',
			},
			mapMarker: {
				type: 'object',
				source: 'meta',
				meta: '_map_marker',
			},
			mapUrl: {
				type: 'string',
				source: 'meta',
				meta: '_map_url',
			},
		},

		edit,
		save: () => null,
	} );
}
