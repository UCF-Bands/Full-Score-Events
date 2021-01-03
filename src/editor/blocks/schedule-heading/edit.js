/**
 * Schedule heading block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';

const ALLOWED_BLOCKS = [ 'full-score-events/callout' ];

const BLOCKS_TEMPLATE = [ [ 'full-score-events/callout' ] ];

export default function edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps(),
		{ heading } = attributes;

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h4"
				className="fse-schedule-heading-heading"
				placeholder={ __( 'Day 1: UCF vs NAVY', 'full-score-events' ) }
				value={ heading }
				onChange={ ( value ) => setAttributes( { heading: value } ) }
				alloedFormats={ [
					'core/code',
					'core/link',
					'core/strikethrough',
					'core/underline',
					'core/subscript',
					'core/superscript',
					'core/keyboard',
				] }
			/>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ BLOCKS_TEMPLATE }
			/>
		</div>
	);
}
