/**
 * Schedule editor block edit
 *
 * @since   1.0.0
 */

import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { TextControl, Button, IconButton } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	const { items } = attributes;

	console.log( 'ITEMS!', items );

	const handleAddItem = () => {
		const newItems = [ ...items ];
		newItems.push( {
			time: '',
			activity: '',
		} );
		setAttributes( { items: newItems } );
	};

	const handleRemoveItem = ( index ) => {
		const newItems = [ ...items ];
		newItems.splice( index, 1 );
		setAttributes( { items: newItems } );
	};

	const handleActivityChange = ( activity, index ) => {
		const newItems = [ ...items ];
		newItems[ index ].activity = activity;
		setAttributes( { items: newItems } );
	};

	let itemFields;

	if ( items.length ) {
		itemFields = items.map( ( thing, index ) => {
			return (
				<Fragment key={ index }>
					<TextControl
						placeholder={ __(
							'Aight add something',
							'full-score-events'
						) }
						value={ items[ index ].activity }
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
