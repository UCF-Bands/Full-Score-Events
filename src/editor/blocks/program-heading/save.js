/**
 * Program heading block save
 *
 * @since 1.0.0
 */

import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const blockProps = useBlockProps.save(),
		{ heading, subheading, tertiaryHeading } = attributes;

	return (
		<div { ...blockProps }>
			<RichText.Content
				tagName="h4"
				className="fse-program-heading-heading"
				value={ heading }
			/>
			<RichText.Content
				tagName="p"
				className="fse-program-subheading"
				value={ subheading }
			/>
			<RichText.Content
				tagName="p"
				className="fse-program-tertiary-heading"
				value={ tertiaryHeading }
			/>
		</div>
	);
}
