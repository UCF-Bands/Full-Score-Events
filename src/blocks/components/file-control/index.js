/**
 * Media InspectorControls handler for files
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { withSelect } from '@wordpress/data';
import { MediaUpload } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { BaseControl, Button } from '@wordpress/components';

const FileControl = withSelect( ( select, { attachmentID } ) => {
	return {
		attachmentPost: select( 'core' ).getEntityRecord(
			'postType',
			'attachment',
			attachmentID
		),
	};
} )( ( { label, attachmentID, onSelect, onClear, attachmentPost } ) => {
	const description = attachmentPost?.description?.rendered;

	return (
		// eslint-disable-next-line @wordpress/no-base-control-with-label-without-id
		<BaseControl label={ label }>
			<MediaUpload
				onSelect={ onSelect }
				value={ attachmentID }
				render={ ( { open } ) => {
					return (
						<div className="components-base-control__field">
							<Button isSecondary onClick={ open }>
								{ __( 'Select File', 'full-score-events' ) }
							</Button>

							{ attachmentID > 0 && (
								<Fragment>
									{ '\u00A0\u00A0' }
									<Button
										isDestructive
										isSecondary
										onClick={ onClear }
									>
										{ __( 'Remove', 'full-score-events' ) }
									</Button>
								</Fragment>
							) }
						</div>
					);
				} }
			/>

			{ attachmentID > 0 && attachmentPost && (
				<div
					className="fse-attachment-description"
					dangerouslySetInnerHTML={ { __html: description } }
				/>
			) }
		</BaseControl>
	);
} );

export default FileControl;
