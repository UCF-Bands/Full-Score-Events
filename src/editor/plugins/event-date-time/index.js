/**
 * Event date/time settings
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { ToggleControl } from '@wordpress/components';

import DateTimeControl from './date-time-control';

const render = compose(
	/*
	 * withDispatch allows us to save meta values
	 */
	withDispatch( ( dispatch ) => ( {
		setDateStart: ( value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { _date_start: value },
			} );
		},
		setDateFinish: ( value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { _date_finish: value },
			} );
		},
		setShowFinish: ( value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { _show_finish: Boolean( value ) },
			} );
		},
		setIsAllDay: ( value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { _is_all_day: Boolean( value ) },
			} );
		},
		setIsTimeTba: ( value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { _is_time_tba: Boolean( value ) },
			} );
		},
	} ) ),

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
			dateStart: meta._date_start,
			dateFinish: meta._date_finish,
			showFinish: meta._show_finish,
			isAllDay: meta._is_all_day,
			isTimeTba: meta._is_time_tba,
		};
	} )
)(
	( {
		postType,
		dateStart,
		dateFinish,
		showFinish,
		isAllDay,
		isTimeTba,
		setDateStart,
		setDateFinish,
		setShowFinish,
		setIsAllDay,
		setIsTimeTba,
	} ) => {
		// sanity check for event
		if ( postType !== 'fse_event' ) {
			return null;
		}

		return (
			<PluginDocumentSettingPanel
				className="fse-event-date-time"
				title={ __( 'Date & Time', 'full-score-events' ) }
			>
				<DateTimeControl
					label={ __( 'Start Date', 'full-score-events' ) }
					date={ dateStart }
					onChange={ ( value ) => setDateStart( value ) }
				/>
				<DateTimeControl
					label={ __( 'Finish Date', 'full-score-events' ) }
					date={ dateFinish }
					onChange={ ( value ) => setDateFinish( value ) }
				/>
				<ToggleControl
					label={ __( 'All-Day Event', 'full-score-events' ) }
					help={ __(
						'Displays "Daily" instead of the start/finish time',
						'full-score-events'
					) }
					checked={ isAllDay }
					onChange={ ( value ) => setIsAllDay( value ) }
				/>
				{ ! isAllDay && (
					<ToggleControl
						label={ __( 'Time TBA', 'full-score-events' ) }
						checked={ isTimeTba }
						onChange={ ( value ) => setIsTimeTba( value ) }
					/>
				) }
				{ ! isAllDay && ! isTimeTba && (
					<ToggleControl
						label={ __( 'Show Finish Time', 'full-score-events' ) }
						checked={ showFinish }
						onChange={ ( value ) => setShowFinish( value ) }
						disabled={ isTimeTba }
					/>
				) }
			</PluginDocumentSettingPanel>
		);
	}
);

// register the sidebar plugin
registerPlugin( 'fse-event-date-time', { render, icon: 'calendar-alt' } );
