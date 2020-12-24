/**
 * Callout block save
 *
 * @since 1.0.0
 */

import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function edit( { attributes } ) {
	const blockProps = useBlockProps.save(),
		{ message } = attributes;

	return (
		<div { ...blockProps }>
			<RichText.Content
				tagName="p"
				className="fse-callout-message"
				value={ message }
			/>
		</div>
	);
}
