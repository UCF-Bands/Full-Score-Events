/**
 * Location block edit
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

export default function edit( { attributes, setAttributes } ) {
	const { selectedPost, showAddress, showMap } = attributes;

	const showAddressControl = (
		<ToggleControl
			label={ __( 'Display Address', 'full-score-events' ) }
			checked={ showAddress }
			onChange={ ( value ) => setAttributes( { showAddress: value } ) }
		/>
	);

	const showMapControl = (
		<ToggleControl
			label={ __( 'Display Map', 'full-score-events' ) }
			checked={ showMap }
			onChange={ ( value ) => setAttributes( { showMap: value } ) }
		/>
	);

	let block;

	if ( ! showAddress && ! showMap ) {
		block = (
			<p>
				{ __(
					'Please enable address and/or map in block settings',
					'full-score-events'
				) }
			</p>
		);
	} else if ( selectedPost.value ) {
		block = (
			<ServerSideRender
				block="full-score-events/location"
				attributes={ attributes }
			/>
		);
	} else {
		block = (
			<p>
				{ __(
					'Please select a location in block options.',
					'full-score-events'
				) }
			</p>
		);
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Title', 'full-score-events' ) }>
					{ showAddressControl }
					{ showMapControl }
				</PanelBody>
			</InspectorControls>

			{ block }
		</>
	);
}
