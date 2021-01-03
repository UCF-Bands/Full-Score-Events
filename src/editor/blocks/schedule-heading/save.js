/**
 * Schedule heading block save
 *
 * @since 1.0.0
 */

import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const blockProps = useBlockProps.save(),
		{ heading } = attributes;

	return (
		<div { ...blockProps }>
			<RichText.Content
				tagName="h4"
				className="fse-schedule-heading-heading"
				value={ heading }
			/>
			<InnerBlocks.Content />
		</div>
	);
}
