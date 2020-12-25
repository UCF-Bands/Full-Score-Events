/**
 * Get label/value pairs from WP API request for react-select options
 *
 * @see   https://react-select.com/async
 * @since 1.0.0
 */

import { addQueryArgs } from '@wordpress/url';
import apiFetch from '@wordpress/api-fetch';

// fetch abort controller and flags
let controller = new window.AbortController();
let signal = controller.signal;
let currentFetch = null;
let isFetching = false;

/**
 * Get result from API and format for react-select options
 *
 * @param {string}   endpoint  REST API endpoint
 * @param {string}   search    searched value
 * @param {callback} callback  link back to react-select
 * @param {string}   namespace namespace for endpoint (defaults to WP V2)
 *
 * @since 1.0.0
 */
const getApiOptions = ( endpoint, search, callback, namespace = 'wp/v2' ) => {
	// cut off existing API fetch and set up a new abort controller.
	if ( currentFetch && isFetching ) {
		controller.abort();
		controller = new window.AbortController();
		signal = controller.signal;
	}

	// if we've gotten this far, we're fetching #StopTryingToMakeFetchHappen
	isFetching = true;

	currentFetch = apiFetch( {
		path: addQueryArgs( `/${ namespace }/${ endpoint }`, {
			search: encodeURIComponent( search ),
		} ),
		signal,
	} )
		.then( ( response ) => {
			// reset flag and init options array
			isFetching = false;
			const options = [];

			// format the options
			// console.log( 'RESPONSE', typeof response, response );
			response.forEach( ( { id, title, name } ) => {
				options.push( {
					label: title ? title.rendered : name,
					value: id,
				} );
			} );

			callback( options );
		} )
		.catch( ( error ) => {
			if ( 'fetch_error' !== error.code ) {
				console.log( 'CAUGHT ERROR:', error ); // eslint-disable-line no-console
			}
		} );
};

export default getApiOptions;
