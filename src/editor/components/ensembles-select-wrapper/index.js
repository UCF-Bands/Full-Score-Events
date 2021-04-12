/**
 * Higher order component for adding ensemble term filtering to a block
 *
 * @since 1.0.0
 * @see   https://jschof.com/gutenberg-blocks/sharing-functionality-between-gutenberg-blocks/
 */

import { __ } from '@wordpress/i18n';
import { withSelect } from '@wordpress/data';
import { Fragment } from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

import EnsemblesControl from '../ensembles-control';

/**
 * Edit/save wrapper with ensemble selection functionality.
 *
 * @param  {Object} blockConfig   Base block configs that we're adding things to.
 * @return {Object} wrappedConfig Base block wrapped in extra ensemble functionality.
 *
 * @since 1.0.0
 */
const EnsemblesSelectWrapper = ( blockConfig ) => {
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
	 * @since 1.0.0
	 *
	 * @param  {Object} props Block properties for editing.
	 * @return {Object}       post-select-wrapped block edit
	 */
	blockConfig.edit = withSelect( ( select, props ) => ( {
		ensembles: select( 'core' ).getEntityRecords(
			'taxonomy',
			'fse_ensemble',
			{ include: props.attributes.ensembles }
		),
		ensembleSuggestions: select( 'core' ).getEntityRecords(
			'taxonomy',
			'fse_ensemble'
		),
	} ) )( ( props ) => {
		const { setAttributes, ensembles } = props;

		// set default arrays in case there aren't any available yet
		const ensembleSuggestions = props.ensembleSuggestions || [];

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody
						title={ __( 'Ensembles', 'full-score-events' ) }
						initialOpen={ true }
					>
						<EnsemblesControl
							ensembles={ ensembles }
							suggestions={ ensembleSuggestions }
							setEnsembles={ ( options ) => {
								setAttributes( { ensembles: options } );
							} }
						/>
					</PanelBody>
				</InspectorControls>

				{ edit( props ) }
			</Fragment>
		);
	} );

	return blockConfig;
};

export default EnsemblesSelectWrapper;
