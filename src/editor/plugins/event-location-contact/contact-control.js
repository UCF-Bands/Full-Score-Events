/**
 * Event primary contact staff post selection control
 *
 * @todo  Combine this and location-control into a post-select-control?
 * @since 1.0.0
 */

import AsyncSelect from 'react-select/async';

import { __ } from '@wordpress/i18n';
import { BaseControl, Button } from '@wordpress/components';

import getApiOptions from '../../util/get-api-options';

const ContactControl = ( { contact, contactPost, setContact } ) => (
	<BaseControl
		className="fse-contact-control fse-post-select-control"
		id="fse-contact-select"
		label={ __( 'Primary Contact', 'full-score-events' ) }
	>
		<AsyncSelect
			name="kb-post-select"
			value={
				contactPost
					? {
							label: contactPost.title.rendered,
							value: contact,
					  }
					: {}
			}
			onChange={ ( option ) => setContact( option.value ) }
			loadOptions={ ( inputValue, callback ) =>
				getApiOptions( 'fse_staff', inputValue, callback )
			}
			placeholder={ __( 'Start typing staff name', 'full-score-events' ) }
			noOptionsMessage={ () =>
				__( 'No options. Start typing staff name', 'full-score-events' )
			}
		/>
		{ contactPost && (
			<Button
				className="fse-contact-remove fse-post-select-remove"
				isLink
				isDestructive
				onClick={ () => setContact( 0 ) }
			>
				{ __( 'Remove', 'full-score-events' ) }
			</Button>
		) }
	</BaseControl>
);

export default ContactControl;
