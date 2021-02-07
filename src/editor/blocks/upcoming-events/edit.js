/**
 * Upcoming events block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	const { number } = attributes;

	const numberControl = (
		<TextControl
			label={ __( 'Number to show', 'full-score-events' ) }
			type="number"
			min={ 1 }
			step={ 1 }
			value={ number }
			onChange={ ( value ) =>
				setAttributes( { number: Number( value ) } )
			}
		/>
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Title', 'full-score-events' ) }>
					{ numberControl }
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps() }>
				<ServerSideRender
					block="full-score-events/upcoming-events"
					attributes={ attributes }
				/>
			</div>
		</>
	);
}
