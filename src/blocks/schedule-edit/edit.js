/**
 * Schedule editor block edit
 *
 * @since   1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { RichText, useBlockProps } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { TextControl, Button, IconButton } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	// const { items } = attributes;

	const postType = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

	// Get schedule items meta and parse (empty array default)
	let items = meta._schedule_items;
	items = items ? JSON.parse( items ) : JSON.parse( '[]' );

	const updateItems = ( newItems ) => {
		setMeta( { ...meta, _schedule_items: JSON.stringify( newItems ) } );
	};

	// console.log( 'ITEMS!', items );
	// JP: FIGURE OUT WHY THIS CAN'T SAVE OVER EXISTING META?!!?

	const handleAddItem = () => {
		const newItems = [ ...items ];
		newItems.push( {
			time: '',
			activity: JSON.stringify( '' ),
		} );
		updateItems( newItems );
		// setAttributes( { items: newItems } );
	};

	const handleRemoveItem = ( index ) => {
		const newItems = [ ...items ];
		newItems.splice( index, 1 );
		updateItems( newItems );
		// setAttributes( { items: newItems } );
	};

	const handleActivityChange = ( activity, index ) => {
		const newItems = [ ...items ];
		newItems[ index ].activity = JSON.stringify( activity );
		updateItems( newItems );
		// setAttributes( { items: newItems } );
	};

	let itemFields;

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
		<div { ...blockProps }>
			{ itemFields }
			<Button isPrimary onClick={ handleAddItem.bind( this ) }>
				{ __( 'Add Activity', 'full-score-events' ) }
			</Button>
		</div>
	);
}
