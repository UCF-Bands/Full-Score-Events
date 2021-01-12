/**
 * Event primary contact user selection control
 *
 * @since 1.0.0
 */

import { debounce } from 'lodash';

import { __ } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import { ComboboxControl } from '@wordpress/components';

const ContactControl = ( {
	contact,
	contactUsers,
	contactIsRequesting,
	setContact,
} ) => {
	/**
	 * Track the state of the user selector
	 *
	 * contactValue is required for setContactValue to work.
	 */
	const [ contactValue, setContactValue ] = useState();

	// build ComboBox options array if we got users and we aren't still
	// looking for more
	let contactAvatar = false;

	const contactOptions = // @todo blog this?
		! contactUsers || contactIsRequesting
			? false
			: contactUsers.map( ( user ) => {
					// check for selected user's avatar
					if ( user.id === contact ) {
						contactAvatar =
							user.avatar_urls[ 48 ] ??
							user.avatar_urls[ 24 ] ??
							false;
					}

					return {
						value: user.id,
						label: user.name,
					};
			  } );

	/**
	 * Ensure that the contact is set? (author selector does this)
	 */
	useEffect( () => {
		if ( contact ) {
			setContactValue( contact );
		}
	}, [ contact ] );

	/**
	 * Handle search input
	 *
	 * @param {Object} inputValue
	 *
	 */
	const handleKeydown = ( inputValue ) => {
		setContactValue( inputValue );
	};

	return (
		<div className="fse-user-control">
			{ contactOptions ? (
				<ComboboxControl
					label={ __( 'Primary Contact', 'full-score-events' ) }
					options={ contactOptions }
					value={ contact }
					onFilterValueChange={ debounce( handleKeydown, 300 ) }
					onChange={ ( userId ) => setContact( userId ) }
					isLoading={ contactIsRequesting }
					allowReset={ true }
				/>
			) : (
				<p className="fse-loading-users">
					<strong>
						{ __( 'Loading users…', 'full-score-events' ) }
					</strong>
				</p>
			) }

			{ contactAvatar && (
				<img
					src={ contactAvatar }
					width="48"
					height="48"
					alt={ __(
						"Selected primary contact's avatar",
						'full-score-events'
					) }
				/>
			) }
		</div>
	);
};

export default ContactControl;
