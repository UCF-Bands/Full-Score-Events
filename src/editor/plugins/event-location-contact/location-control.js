/**
 * Event location post selection control
 *
 * @since 1.0.0
 */

import AsyncSelect from 'react-select/async';

import { __ } from '@wordpress/i18n';
import { BaseControl, Button } from '@wordpress/components';

import getApiOptions from '../../util/get-api-options';

const LocationControl = ( { location, locationPost, setLocation } ) => (
	<BaseControl
		className="fse-location-control fse-post-select-control"
		id="fse-location-select"
		label={ __( 'Location', 'full-score-events' ) }
	>
		<AsyncSelect
			name="kb-post-select"
			value={
				locationPost
					? {
							label: locationPost.title.rendered,
							value: location,
					  }
					: {}
			}
			onChange={ ( option ) => setLocation( option.value ) }
			loadOptions={ ( inputValue, callback ) =>
				getApiOptions( 'fse_location', inputValue, callback )
			}
			placeholder={ __(
				'Start typing location name',
				'full-score-events'
			) }
			noOptionsMessage={ () =>
				__(
					'No options. Start typing location name',
					'full-score-events'
				)
			}
		/>
		{ locationPost && (
			<Button
				className="fse-location-remove fse-post-select-remove"
				isLink
				isDestructive
				onClick={ () => setLocation( 0 ) }
			>
				{ __( 'Remove', 'full-score-events' ) }
			</Button>
		) }
	</BaseControl>
);

export default LocationControl;
