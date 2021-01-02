/**
 * Schedule editor block edit
 *
 * @since   1.0.0
 */

import { __ } from '@wordpress/i18n';
import { __experimentalGetSettings } from '@wordpress/date';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { Button, IconButton, TimePicker } from '@wordpress/components';

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

export default function edit( { attributes, setAttributes } ) {
	let { items } = attributes;

	// convert to array of items
	items = JSON.parse( items );

	// set items attribute
	const updateItems = ( newItems ) => {
		setAttributes( { items: JSON.stringify( newItems ) } );
	};

	// add a new, blank item using the last item's date as the date
	const handleAddItem = () => {
		const newItems = [ ...items ],
			lastItem = newItems[ newItems.length - 1 ];

		newItems.push( {
			dateTime: lastItem ? lastItem.dateTime : '',
			activity: '',
		} );
		updateItems( newItems );
	};

	// remove item at index
	const handleRemoveItem = ( index ) => {
		const newItems = [ ...items ];
		newItems.splice( index, 1 );
		updateItems( newItems );
	};

	// handle a single schedule item's activity being edited
	const handleActivityChange = ( activity, index ) => {
		const newItems = [ ...items ];
		newItems[ index ].activity = activity;
		updateItems( newItems );
	};

	const handleDateTimeChange = ( dateTime, index ) => {
		const newItems = [ ...items ];
		newItems[ index ].dateTime = dateTime;
		updateItems( newItems );
	};

	let itemFields;

	// loop through the items and create a field to edit it and a button to
	// remove it.
	if ( items.length ) {
		itemFields = items.map( ( thing, index ) => {
			return (
				<Fragment key={ index }>
					<TimePicker
						currentTime={ thing.dateTime }
						onChange={ ( dateTime ) =>
							handleDateTimeChange( dateTime, index )
						}
						is12Hour={ is12HourTime }
					/>
					<RichText
						tagName="p"
						value={ thing.activity }
						onChange={ ( value ) =>
							handleActivityChange( value, index )
						}
					/>
					<IconButton
						icon="no-alt"
						label={ __( 'Delete Activity', 'full-score-events' ) }
						onClick={ () => handleRemoveItem( index ) }
					/>
				</Fragment>
			);
		} );
	}

	return (
		<Fragment>
			{ itemFields }
			<Button isPrimary onClick={ handleAddItem.bind( this ) }>
				{ __( 'Add Activity', 'full-score-events' ) }
			</Button>
		</Fragment>
	);
}
