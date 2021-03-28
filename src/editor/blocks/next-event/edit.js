/**
 * Next event block edit
 *
 * @since 1.0.0
 */

import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	const { heading } = attributes;

	const headingControl = (
		<TextControl
			label={ __( 'Heading', 'full-score-events' ) }
			value={ heading }
			onChange={ ( value ) => setAttributes( { heading: value } ) }
		/>
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Layout', 'full-score-events' ) }>
					{ headingControl }
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps() }>
				<ServerSideRender
					block="full-score-events/next-event"
					attributes={ attributes }
				/>
			</div>
		</>
	);
}
