/**
 * Program heading block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

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
			/>
		</div>
	);
}
