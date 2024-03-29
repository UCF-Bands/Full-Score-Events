/**
 * Upcoming events block edit
 *
 * @since 1.0.0
 */

import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	const { number, noneFound } = attributes;

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

	const noneFoundControl = (
		<TextareaControl
			label={ __( '"None found" message', 'full-score-events' ) }
			value={ noneFound }
			placeholder={ __(
				"Ex: There aren't any scheduled events at this time.",
				'full-score-events'
			) }
			onChange={ ( value ) => setAttributes( { noneFound: value } ) }
			help={ `${ __(
				"Leave empty to not display block if there aren't any upcoming events found.",
				'full-score-events'
			) } ${ fullScoreEventsEditor.allowedInlineHTML }` }
		/>
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Layout', 'full-score-events' ) }>
					{ numberControl }
					{ noneFoundControl }
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
