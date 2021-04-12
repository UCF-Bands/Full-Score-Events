/**
 * Select dropdown for ensemble terms
 *
 * @todo write a blog on this?
 *
 * @since 1.0.0
 */

import AsyncSelect from 'react-select/async';

import { __ } from '@wordpress/i18n';
import { BaseControl } from '@wordpress/components';

import getApiOptions from '../../util/get-api-options';

const EnsemblesControl = ( { ensembles, suggestions, setEnsembles } ) => (
	<BaseControl
		className="fse-ensembles-control"
		id="fse-ensembles-select"
		label={ __( 'Filter to', 'full-score-events' ) }
	>
		<AsyncSelect
			name="fse-post-select"
			isMulti
			placeholder={ __(
				'Start typing ensemble name',
				'full-score-events'
			) }
			value={ ensembles.map( ( term ) => ( {
				label: term.name,
				value: term.id,
			} ) ) }
			defaultOptions={ suggestions.map( ( term ) => ( {
				label: term.name,
				value: term.id,
			} ) ) }
			loadOptions={ ( inputValue, callback ) =>
				getApiOptions( 'fse_ensemble', inputValue, callback )
			}
			noOptionsMessage={ () => {
				__(
					'No options. Start typing ensemble name',
					'full-score-events'
				);
			} }
			onChange={ ( options ) => {
				options = options || [];
				options = options.map( ( option ) => option.value );
				setEnsembles( options );
			} }
		/>
	</BaseControl>
);

export default EnsemblesControl;
