/**
 * Schedule upload sidebar plugin
 *
 * @since 1.0.0
 */

// this needs to be put back into Schedules.php to work:
// /**
//  * Register meta
//  *
//  * @since 1.0.0
//  */
// public function do_meta_registration() {

// 	foreach ( [
// 		'_schedule_upload' => 'number',
// 	] as $key => $type ) {
// 		register_post_meta(
// 			$this::CPT_KEY,
// 			$key,
// 			[
// 				'type'          => $type,
// 				'single'        => true,
// 				'show_in_rest'  => true,
// 				'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
// 			]
// 		);
// 	}
// }

import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { registerPlugin } from '@wordpress/plugins';

import FileControl from '../../components/file-control';

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

	const { uploadId, setUploadId } = props;

	return (
		<PluginDocumentSettingPanel
			className="fse-schedule-upload"
			title={ __( 'Schedule Upload', 'full-score-events' ) }
		>
			<FileControl
				attachmentID={ uploadId }
				onSelect={ ( media ) => setUploadId( Number( media.id ) ) }
				onClear={ () => setUploadId( 0 ) }
			/>
		</PluginDocumentSettingPanel>
	);
} );

// register the sidebar plugin
registerPlugin( 'fse-schedule-upload', { render, icon: 'tag' } );
