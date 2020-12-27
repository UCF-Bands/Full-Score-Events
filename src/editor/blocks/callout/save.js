/**
 * Callout block save
 *
 * @since 1.0.0
 */

import { useBlockProps, RichText } from '@wordpress/block-editor';

import icons from './icons';

export default function edit( { attributes } ) {
	const blockProps = useBlockProps.save(),
		{ message, type } = attributes;

	return (
		<div { ...blockProps }>
			{ icons[ type ]() }
			<RichText.Content
				tagName="p"
				className="fse-callout-message"
				value={ message }
			/>
		</div>
	);
}
