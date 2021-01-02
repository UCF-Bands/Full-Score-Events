/**
 * Program piece block edit
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

export default function edit( { attributes, setAttributes, isSelected } ) {
	const blockProps = useBlockProps(),
		{ title, note, composer, arranger } = attributes;

	return (
		<div { ...blockProps }>
			<RichText
				tagName="p"
				className="fse-piece-title"
				placeholder={ __(
					'Ex: Big Noise from Winnetka',
					'full-score-events'
				) }
				value={ title }
				onChange={ ( value ) => setAttributes( { title: value } ) }
				allowedFormats={ ALLOWED_FORMATS }
			/>

			<p className="fse-piece-composer">
				<span className="screen-reader-text">
					{ __( 'Composed by', 'full-score-events' ) }
				</span>
				{ ` ` }
				<RichText
					tagName="span"
					className="fse-piece-composer-name"
					placeholder={ __( 'Ex: Bob Haggart', 'full-score-events' ) }
					value={ composer }
					onChange={ ( value ) =>
						setAttributes( { composer: value } )
					}
					allowedFormats={ ALLOWED_FORMATS }
				/>
			</p>

			{ ( note || isSelected ) && (
				<RichText
					tagName="small"
					className="fse-piece-note"
					placeholder={ __(
						'Ex: Lazlo Marosi, Conductor',
						'full-score-events'
					) }
					value={ note }
					onChange={ ( value ) => setAttributes( { note: value } ) }
					allowedFormats={ ALLOWED_FORMATS }
				/>
			) }

			{ ( arranger || isSelected ) && (
				<small className="fse-piece-arranger">
					<span className="fse-arranger-label">
						{ __( 'Arr.', 'full-score-events' ) }
					</span>
					{ ` ` }
					<RichText
						tagName="span"
						className="fse-piece-arranger-name"
						placeholder={ __(
							'Ex: Ron Ellis',
							'full-score-events'
						) }
						value={ arranger }
						onChange={ ( value ) =>
							setAttributes( { arranger: value } )
						}
						allowedFormats={ ALLOWED_FORMATS }
					/>
				</small>
			) }
		</div>
	);
}
