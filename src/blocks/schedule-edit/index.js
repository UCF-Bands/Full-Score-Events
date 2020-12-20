/**
 * Schedule editing block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { formatListBullets as icon } from '@wordpress/icons';

import edit from './edit';

// import './style.css';
// import './index.css';

// only allow schedule editing in schedule CPT
if ( fullScoreEventsEditor.currentCPT === 'fse_schedule' ) {
	registerBlockType( 'full-score-events/schedule-edit', {
		title: __( 'Schedule Editor', 'full-score-events' ),
		description: __( "Edit a schedule's items.", 'knight-blocks' ),
		icon,
		keywords: [ __( 'schedule' ), __( 'plan' ) ],

		// attributes: {
		// 	items: {
		// 		type: 'array',
		// 		source: 'meta',
		// 		meta: '_schedule_items',
		// 	},
		// },

		edit,
		save: () => null,
	} );
}
