/**
 * Event date/time settings
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { ToggleControl } from '@wordpress/components';

import pluginMetaHandler from '../../util/plugin-meta-handler';
import DateTimeControl from '../../components/date-time-control';

const render = pluginMetaHandler( {
	dateStart: {
		key: '_date_start',
	},
	dateFinish: {
		key: '_date_finish',
	},
	showFinish: {
		key: '_show_finish',
		type: 'boolean',
	},
	isAllDay: {
		key: '_is_all_day',
		type: 'boolean',
	},
	isTimeTba: {
		key: '_is_time_tba',
		type: 'boolean',
	},
} )(
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
