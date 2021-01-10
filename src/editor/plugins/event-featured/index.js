/**
 * Featured event handling sidebar plugin
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';
import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { ToggleControl } from '@wordpress/components';

// import './index.scss';

const render = compose(
	/*
	 * withSelect allows us to get existing meta values
	 */
	withSelect( ( select ) => {
		const meta = Object.assign(
			{},
			select( 'core/editor' ).getEditedPostAttribute( 'meta' )
		);

		return {
			postType: select( 'core/editor' ).getCurrentPostType(),
			isFeatured: meta._is_featured,
		};
	} ),

	/*
	 * withDispatch allows us to save meta values
	 */
	withDispatch( ( dispatch ) => {
		const setMeta = ( key, value ) => {
			const meta = {};
			meta[ key ] = value;
			dispatch( 'core/editor' ).editPost( { meta } );
		};

		return {
			setIsFeatured: ( value ) =>
				setMeta( '_is_featured', Boolean( value ) ),
		};
	} )
)( ( { postType, isFeatured, setIsFeatured } ) => {
	// sanity check for event
	if ( postType !== 'fse_event' ) {
		return null;
	}

	return (
		<PluginPostStatusInfo>
			<ToggleControl
				label={ __( 'Special Event', 'full-score-events' ) }
				help={ __(
					'Feature this event on the events page.',
					'full-score-events'
				) }
				checked={ isFeatured }
				onChange={ ( value ) => setIsFeatured( value ) }
			/>
		</PluginPostStatusInfo>
	);
} );

// register the sidebar plugin
registerPlugin( 'fse-event-featured', { render, icon: 'tickets-alt' } );
