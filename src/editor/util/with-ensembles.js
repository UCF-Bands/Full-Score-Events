/**
 * withSelect wrapper/data prep for ensembles and ensemble suggestions
 *
 * @since 1.0.0
 */

import { withSelect } from '@wordpress/data';

const withEnsembles = withSelect( ( select, { attributes } ) => ( {
	ensembles: select( 'core' ).getEntityRecords( 'taxonomy', 'fse_ensemble', {
		include: attributes.ensembles,
	} ),
	ensembleSuggestions: select( 'core' ).getEntityRecords(
		'taxonomy',
		'fse_ensemble'
	),
} ) );

export default withEnsembles;
