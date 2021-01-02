/**
 * Callout block save
 *
 * @since 1.0.0
 */

import { useBlockProps, RichText } from '@wordpress/block-editor';

import icons from './icons';

export default function edit( { attributes } ) {
	const { type, message } = attributes;

	const blockProps = useBlockProps.save( {
		className: `fse-callout-${ type }`,
	} );

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
