/**
 * Higher order component for adding ensemble term filtering to a block
 *
 * @see   https://jschof.com/gutenberg-blocks/sharing-functionality-between-gutenberg-blocks/
 * @since 1.0.0
 */

import AsyncSelect from 'react-select/async';

import { __, sprintf } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

import getApiOptions from '../../util/get-api-options';

/**
 * Edit/save wrapper with ensemble selection functionality.
 *
 * @param  {Object} blockConfig   Base block configs that we're adding things to.
 * @return {Object} wrappedConfig Base block wrapped in extra ensemble functionality.
 *
 * @since 1.0.0
 */
const EnsemblesWrapper = ( blockConfig ) => {
	const { edit, attributes } = blockConfig;

	// add ensembles attribute
	blockConfig.attributes = {
		ensembles: {
			type: 'array',
			default: [],
		},
		...attributes,
	};

	/**
	 * Edit function that runs the base block's edit
	 *
	 * @param  {Object} props Block properties for editing.
	 * @return {Object}       post-select-wrapped block edit
	 *
	 * @since 1.0.0
	 */
	blockConfig.edit = ( props ) => {
		const { setAttributes, attributes } = props;
		const { selectedPost } = attributes;

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody
						title={ __( 'Ensembles', 'full-score-events' ) }
						initialOpen={ true }
					>
						<p>BRICK!</p>
					</PanelBody>
				</InspectorControls>

				{ edit( props ) }
			</Fragment>
		);
	};

	return blockConfig;
};

export default EnsemblesWrapper;
