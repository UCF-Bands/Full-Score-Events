/**
 * Schedule editor block edit
 *
 * @since   1.0.0
 */

import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { Button, IconButton } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	let { items } = attributes;

	// convert to array of items
	items = JSON.parse( items );

	// set items attribute
	const updateItems = ( newItems ) => {
		setAttributes( { items: JSON.stringify( newItems ) } );
	};

	// add a new, blank item
	const handleAddItem = () => {
		const newItems = [ ...items ];
		newItems.push( {
			time: '',
			activity: JSON.stringify( '' ),
		} );
		updateItems( newItems );
	};

	// remove item at index
	const handleRemoveItem = ( index ) => {
		const newItems = [ ...items ];
		newItems.splice( index, 1 );
		updateItems( newItems );
	};

	// handle a single schedule item being edited
	const handleActivityChange = ( activity, index ) => {
		const newItems = [ ...items ];
		newItems[ index ].activity = JSON.stringify( activity );
		updateItems( newItems );
	};

	let itemFields;

	// loop through the items and create a field to edit it and a button to
	// remove it.
	if ( items.length ) {
		itemFields = items.map( ( thing, index ) => {
			return (
				<Fragment key={ index }>
					<RichText
						tagName="p"
						value={ JSON.parse( thing.activity ) }
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
