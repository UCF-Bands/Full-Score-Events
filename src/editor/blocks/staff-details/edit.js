/**
 * Staff details block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

import icons from '../../../icons';

export default function edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps(),
		{ title, phoneDisplay, email } = attributes;

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h3"
				className="fse-staff-detail-edit fse-staff-title-edit"
				placeholder={ __( 'Director of Bands', 'full-score-events' ) }
				value={ title }
				onChange={ ( value ) => setAttributes( { title: value } ) }
				allowedFormats={ [] }
				autocompleters={ [] }
			/>

			<p className="fse-staff-detail-edit fse-staff-email-edit">
				<strong>
					{ icons.envelope() }
					{ ` ` }
					<RichText
						tagName="span"
						className="fse-staff-detail-value fse-staff-email-value"
						placeholder={ __(
							'tkizer@ucf.edu',
							'full-score-events'
						) }
						value={ email }
						onChange={ ( value ) =>
							setAttributes( { email: value } )
						}
						allowedFormats={ [] }
						autocompleters={ [] }
					/>
				</strong>
			</p>

			<p className="fse-staff-detail-edit fse-staff-phone-edit">
				<strong>
					{ icons.phone() }
					{ ` ` }
					<RichText
						tagName="span"
						className="fse-staff-detail-value fse-staff-phone-value"
						placeholder={ __(
							'(123) 456-7890',
							'full-score-events'
						) }
						value={ phoneDisplay }
						onChange={ ( value ) =>
							setAttributes( {
								phoneDisplay: value,
								phone: value.replace( /\D/g, '' ), // digits only
							} )
						}
						allowedFormats={ [] }
						autocompleters={ [] }
					/>
				</strong>
			</p>
		</div>
	);
}
