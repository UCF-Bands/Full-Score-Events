/**
 * Staff details block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

import icons from '../../../icons';
import './index.scss';

export default function edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps(),
		{
			position,
			phoneDisplay,
			email,
			facebookLabel,
			facebookURL,
			discordLabel,
			discordURL,
		} = attributes;

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h3"
				className="fse-staff-detail-edit fse-staff-position-edit"
				placeholder={ __( 'Director of Bands', 'full-score-events' ) }
				value={ position }
				onChange={ ( value ) => setAttributes( { position: value } ) }
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

			<p className="fse-staff-detail-edit fse-staff-facebook-label-edit">
				<strong>
					{ icons.facebook() }
					{ ` ` }
					<RichText
						tagName="span"
						className="fse-staff-detail-value fse-staff-facebook-label-value"
						placeholder={ __( 'Facebook', 'full-score-events' ) }
						value={ facebookLabel }
						onChange={ ( value ) => {
							setAttributes( { facebookLabel: value } )
						} }
						allowedFormats={ [] }
						autocompleters={ [] }
					/>
				</strong>

				{ icons.link() }
				{ ` ` }
				<RichText
					tagName="span"
					className="fse-staff-detail-value fse-staff-facebook-label-url"
					placeholder={ __(  'URL', 'full-score-events' ) }
					value={ facebookURL }
					onChange={ ( value ) => {
						setAttributes( { facebookURL: value } )
					} }
					allowedFormats={ [] }
					autocompleters={ [] }
				/>
			</p>

			<p className="fse-staff-detail-edit fse-staff-discord-label-edit">
				<strong>
					{ icons.discord() }
					{ ` ` }
					<RichText
						tagName="span"
						className="fse-staff-detail-value fse-staff-discord-label-value"
						placeholder={ __( 'Discord', 'full-score-events' ) }
						value={ discordLabel }
						onChange={ ( value ) => {
							setAttributes( { discordLabel: value } )
						} }
						allowedFormats={ [] }
						autocompleters={ [] }
					/>
				</strong>

				{ icons.link() }
				{ ` ` }
				<RichText
					tagName="span"
					className="fse-staff-detail-value fse-staff-discord-label-url"
					placeholder={ __(  'URL', 'full-score-events' ) }
					value={ discordURL }
					onChange={ ( value ) => {
						setAttributes( { discordURL: value } )
					} }
					allowedFormats={ [] }
					autocompleters={ [] }
				/>
			</p>
		</div>
	);
}
