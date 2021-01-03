/**
 * Callout block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, RadioControl } from '@wordpress/components';

import icons from './icons';

export default function Edit( { attributes, setAttributes } ) {
	const { type, message } = attributes,
		blockProps = useBlockProps( { className: `fse-callout-${ type }` } );

	const typeControl = (
		<RadioControl
			// label={ __( 'Type', 'full-score-events' ) }
			options={ [
				{
					label: __( 'Info', 'full-score-events' ),
					value: 'info',
				},
				{
					label: __( 'Success', 'full-score-events' ),
					value: 'success',
				},
				{
					label: __( 'Warning', 'full-score-events' ),
					value: 'warning',
				},
				{
					label: __( 'Error', 'full-score-events' ),
					value: 'error',
				},
			] }
			onChange={ ( value ) => setAttributes( { type: value } ) }
			selected={ type }
		/>
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Type', 'full-score-events' ) }>
					{ typeControl }
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				{ icons[ type ]() }
				<RichText
					tagName="p"
					className="fse-callout-message"
					placeholder={ __(
						'Ex: This event has been cancelled due to a pandemic.',
						'full-score-events'
					) }
					value={ message }
					onChange={ ( value ) =>
						setAttributes( { message: value } )
					}
					allowedFormats={ [
						'core/bold',
						'core/italic',
						'core/code',
						'core/link',
						'core/strikethrough',
						'core/underline',
						'core/subscript',
						'core/superscript',
						'core/keyboard',
					] }
				/>
			</div>
		</>
	);
}
