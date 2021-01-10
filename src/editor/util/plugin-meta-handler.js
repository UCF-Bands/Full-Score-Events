/**
 * Create a meta getter and setter for a sidebar plugin
 *
 * @since 1.0.0
 */

import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';

function capitalizeFirstLetter( string ) {
	return string.charAt( 0 ).toUpperCase() + string.slice( 1 );
}

/**
 * Compose a meta selector and dispatcher for the provided meta keys and types
 *
 * @param {Object} meta Meta names/keys/types to select and create dispatchers for
 */
export default function pluginMetaHandler( meta ) {
	/**
	 * Get post meta values for each of the provided meta keys
	 */
	const selector = withSelect( ( select ) => {
		// get all registered post meta
		const postMeta = Object.assign(
			{},
			select( 'core/editor' ).getEditedPostAttribute( 'meta' )
		);

		// init new meta object with postType
		const selected = {
			postType: select( 'core/editor' ).getCurrentPostType(),
		};

		// get meta value for reach of the keys
		for ( const [ key, props ] of Object.entries( meta ) ) {
			selected[ key ] = postMeta[ props.key ];
		}

		return selected;
	} );

	/**
	 * Create post meta setting functions for each of the provided keys
	 */
	const dispatcher = withDispatch( ( dispatch ) => {
		/**
		 * Dispatch an edit for the actual meta value
		 *
		 * @param {string}                key    registered post meta name/key
		 * @param {string|number|boolean} value  new meta value
		 * @param {string}                type   value type
		 */
		const setMeta = ( key, value, type = 'string' ) => {
			const postMeta = {};
			switch ( type ) {
				case 'number':
					value = Number( value );
					break;

				case 'boolean':
					value = Boolean( value );
					break;
			}
			postMeta[ key ] = value;
			dispatch( 'core/editor' ).editPost( { meta: postMeta } );
		};

		const dispatchers = {};

		// Add a setWhatever "dispatcher" for each of the provided keys. If the
		// property isFeatured is passed in, a new property in this dispatchers
		// object would be setIsFeatured.
		for ( const [ key, props ] of Object.entries( meta ) ) {
			dispatchers[ `set${ capitalizeFirstLetter( key ) }` ] = ( value ) =>
				setMeta( props.key, value, props.type );
		}

		return dispatchers;
	} );

	return compose( selector, dispatcher );
}
