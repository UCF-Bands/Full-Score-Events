/**
 * Schedule items block edit
 *
 * Most of this is a stripped form of the file block's edit.
 *
 * @since 1.0.0
 */

/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { getBlobByURL, isBlobURL, revokeBlobURL } from '@wordpress/blob';
import {
	__unstableGetAnimateClassName as getAnimateClassName,
	withNotices,
	ToolbarGroup,
	ToolbarButton,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import {
	BlockControls,
	BlockIcon,
	MediaPlaceholder,
	MediaReplaceFlow,
	useBlockProps,
	InnerBlocks,
} from '@wordpress/block-editor';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { file as icon } from '@wordpress/icons';

const ALLOWED_BLOCKS = [ 'full-score-events/schedule-item' ];

const BLOCKS_TEMPLATE = [ [ 'full-score-events/schedule-item' ] ];

function FileEdit( { attributes, setAttributes, noticeUI, noticeOperations } ) {
	const { uploadId, uploadHref } = attributes;
	const [ hasError, setHasError ] = useState( false );
	const { mediaUpload } = useSelect(
		( select ) => ( {
			media:
				uploadId === undefined
					? undefined
					: select( 'core' ).getMedia( uploadId ),
			mediaUpload: select( 'core/block-editor' ).getSettings()
				.mediaUpload,
		} ),
		[ uploadId ]
	);

	useEffect( () => {
		// Upload a file drag-and-dropped into the editor
		if ( isBlobURL( uploadHref ) ) {
			const file = getBlobByURL( uploadHref );

			mediaUpload( {
				filesList: [ file ],
				onFileChange: ( [ newMedia ] ) => onSelectFile( newMedia ),
				onError: ( message ) => {
					setHasError( true );
					noticeOperations.createErrorNotice( message );
				},
			} );

			revokeBlobURL( uploadHref );
		}
	}, [] );

	function onSelectFile( newMedia ) {
		if ( newMedia && newMedia.url ) {
			setHasError( false );
			setAttributes( {
				uploadHref: newMedia.url,
				uploadId: newMedia.id,
			} );
		}
	}

	function onRemoveFile() {
		setAttributes( {
			uploadHref: '',
			uploadId: null,
		} );
	}

	function onUploadError( message ) {
		setHasError( true );
		noticeOperations.removeAllNotices();
		noticeOperations.createErrorNotice( message );
	}

	const blockProps = useBlockProps( {
		className: classnames(
			isBlobURL( uploadHref ) &&
				getAnimateClassName( { type: 'loading' } ),
			{
				'is-transient': isBlobURL( uploadHref ),
			}
		),
	} );

	if ( ! uploadHref || hasError ) {
		return (
			<div { ...blockProps }>
				<InnerBlocks
					allowedBlocks={ ALLOWED_BLOCKS }
					template={ BLOCKS_TEMPLATE }
				/>

				<MediaPlaceholder
					icon={ <BlockIcon icon={ icon } /> }
					labels={ {
						title: __( 'Schedule Upload' ),
						instructions: __(
							'Upload a file or pick one from your media library.'
						),
					} }
					onSelect={ onSelectFile }
					notices={ noticeUI }
					onError={ onUploadError }
					accept="*"
				/>
			</div>
		);
	}

	return (
		<>
			<BlockControls>
				<ToolbarGroup>
					<MediaReplaceFlow
						mediaId={ uploadId }
						mediaURL={ uploadHref }
						accept="*"
						onSelect={ onSelectFile }
						onError={ onUploadError }
						name={ __( 'Replace Upload', 'full-score-events' ) } // added by JP
					/>
					{ /* added by JP */ }
					<ToolbarButton
						className="components-media-remove-toolbar-button"
						isDisabled={ isBlobURL( uploadHref ) }
						onClick={ onRemoveFile }
					>
						{ __( 'Remove Upload', 'full-score-events' ) }
					</ToolbarButton>
				</ToolbarGroup>
			</BlockControls>

			<div { ...blockProps }>
				<InnerBlocks
					allowedBlocks={ ALLOWED_BLOCKS }
					template={ BLOCKS_TEMPLATE }
				/>

				<div className="schedule-download-wrapper">
					<a href={ uploadHref } download>
						{ __( 'Download', 'full-score-events' ) }
					</a>
					<p className="schedule-upload-instructions">
						{ __(
							'Remove or replace in toolbar',
							'full-score-events'
						) }
					</p>
				</div>
			</div>
		</>
	);
}

export default withNotices( FileEdit );
