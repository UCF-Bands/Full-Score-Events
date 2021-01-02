/**
 * Program heading block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

const ALLOWED_FORMATS = [
	'core/code',
	'core/link',
	'core/strikethrough',
	'core/underline',
	'core/subscript',
	'core/superscript',
	'core/keyboard',
];

export default function edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps(),
		{ heading, subheading, tertiaryHeading } = attributes;

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h4"
				className="fse-program-heading-heading"
				placeholder={ __(
					'Ex: UCF Symphonic Band',
					'full-score-events'
				) }
				value={ heading }
				onChange={ ( value ) => setAttributes( { heading: value } ) }
				allowedFormats={ ALLOWED_FORMATS }
			/>
			<RichText
				tagName="p"
				className="fse-program-subheading"
				placeholder={ __(
					'Ex: Dr. Tremon Kizer, Conductor',
					'full-score-events'
				) }
				value={ subheading }
				onChange={ ( value ) => setAttributes( { subheading: value } ) }
				allowedFormats={ ALLOWED_FORMATS }
			/>
			<RichText
				tagName="p"
				className="fse-program-tertiary-heading"
				placeholder={ __(
					'Ex: Danny Santos, GTA Conductor',
					'full-score-events'
				) }
				value={ tertiaryHeading }
				onChange={ ( value ) =>
					setAttributes( { tertiaryHeading: value } )
				}
				allowedFormats={ ALLOWED_FORMATS }
			/>
		</div>
	);
}
