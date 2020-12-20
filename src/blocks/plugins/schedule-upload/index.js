/**
 * Schedule upload sidebar plugin
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { TextControl } from '@wordpress/components';
import { registerPlugin } from '@wordpress/plugins';

const render = compose(
	/*
	 * withDispatch allows us to save meta values
	 */
	withDispatch( ( dispatch ) => ( {
		setUploadId: ( value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { _schedule_upload: Number( value ) },
			} );
		},
	} ) ),

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
			uploadId: meta._schedule_upload,
		};
	} )
)( ( props ) => {
	// sanity check for product
	if ( props.postType !== 'fse_schedule' ) {
		return null;
	}

	const { uploadId, shopUrl, setUploadId, setShopUrl } = props;

	return (
		<PluginDocumentSettingPanel
			className="fse-schedule-upload"
			title={ __( 'Schedule Upload', 'full-score-events' ) }
		>
			<TextControl
				label={ __( 'Schedule Upload ID', 'full-score-events' ) }
				type="number"
				min={ 0 }
				step={ 1 }
				value={ uploadId }
				onChange={ setUploadId }
			/>
			{ /* <URLInput
				label={ __( 'Shop URL', 'knight-blocks' ) }
				value={ shopUrl }
				onChange={ setShopUrl }
			/>

			<TextControl
				label={ __( 'Price ($)', 'knight-blocks' ) }
				type="number"
				min={ 0 }
				step={ 0.01 }
				value={ price }
				onChange={ setPrice }
			/> */ }
		</PluginDocumentSettingPanel>
	);
} );

// register the sidebar plugin
registerPlugin( 'fse-schedule-upload', { render, icon: 'tag' } );
