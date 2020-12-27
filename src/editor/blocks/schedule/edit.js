/**
 * Schedule block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	const { selectedPost, showTitle } = attributes;

	const showTitleControl = (
		<ToggleControl
			label={ __( 'Display Title', 'full-score-events' ) }
			checked={ showTitle }
			onChange={ ( value ) => setAttributes( { showTitle: value } ) }
		/>
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Title', 'full-score-events' ) }>
					{ showTitleControl }
				</PanelBody>
			</InspectorControls>

			{ selectedPost.value ? (
				<ServerSideRender
					block="full-score-events/schedule"
					attributes={ attributes }
				/>
			) : (
				<p>
					{ __(
						'Please select a schedule in block options.',
						'full-score-events'
					) }
				</p>
			) }
		</>
	);
}
