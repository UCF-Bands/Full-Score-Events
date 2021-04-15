/**
 * Staff details block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { people as icon } from '@wordpress/icons';

import edit from './edit';

// only allow staff details in staff CPT
if ( fullScoreEventsEditor.currentCPT === 'fse_staff' ) {
	registerBlockType( 'full-score-events/staff-details', {
		apiVersion: 2,
		title: __( 'Staff Title & Contacts', 'full-score-events' ),
		icon,
		keywords: [ __( 'staff' ), __( 'faculty' ), __( 'team' ) ],
		category: 'fse-event',

		attributes: {
			title: {
				type: 'string',
				source: 'meta',
				meta: '_title',
			},
			phone: {
				type: 'string',
				source: 'meta',
				meta: '_phone',
			},
			phoneDisplay: {
				type: 'string',
				source: 'meta',
				meta: '_phone_display',
			},
			email: {
				type: 'string',
				source: 'meta',
				meta: '_email',
			},
		},

		edit,
		save: () => null,
	} );
}
