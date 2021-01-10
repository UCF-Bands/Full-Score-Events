/**
 * DateTimePicker in a InspectorControls panel tooltip
 *
 * @since 1.0.0
 */

import { format, __experimentalGetSettings } from '@wordpress/date';
import {
	PanelRow,
	Dropdown,
	Button,
	DateTimePicker,
} from '@wordpress/components';

import './index.scss';

/**
 * Get time format
 *
 * @see https://github.com/WordPress/gutenberg/tree/master/packages/components/src/date-time
 */
const settings = __experimentalGetSettings();

// To know if the current timezone is a 12 hour time with look for an "a" in the time format.
// We also make sure this a is not escaped by a "/".
const is12HourTime = /a(?!\\)/i.test(
	settings.formats.time
		.toLowerCase() // Test only the lower case a
		.replace( /\\\\/g, '' ) // Replace "//" with empty strings
		.split( '' )
		.reverse()
		.join( '' ) // Reverse the string and test for "a" not followed by a slash
);

const getDate = ( date ) =>
	format( `${ settings.formats.date } ${ settings.formats.time }`, date );

const DateTimeControl = ( { label, date, onChange } ) => (
	<PanelRow className="fse-date-time-control">
		{ label && <span>{ label }</span> }
		<Dropdown
			position="bottom left"
			contentClassName="edit-post-post-schedule__dialog"
			renderToggle={ ( { onToggle, isOpen } ) => (
				<>
					<Button
						onClick={ onToggle }
						aria-expanded={ isOpen }
						isTertiary
					>
						{ getDate( date ) }
					</Button>
				</>
			) }
			renderContent={ () => (
				<DateTimePicker
					currentDate={ date }
					onChange={ onChange }
					is12Hour={ is12HourTime }
				/>
			) }
		/>
	</PanelRow>
);

export default DateTimeControl;
