/**
 * Schedule editor block edit
 *
 * @since   1.0.0
 */

import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';

export default function edit( { attributes, setAttributes } ) {
	console.log( 'schedule edit attrs', attributes );
	return <Fragment>{ __( 'KRIK', 'full-score-events' ) }</Fragment>;

	// const { text, icon, iconPosition } = attributes;
	// return (
	// 	<Fragment>
	// 		<RichText
	// 			tagName="span"
	// 			className="icon-link-text"
	// 			value={ text }
	// 			onChange={ ( value ) => setAttributes( { text: value } ) }
	// 			placeholder={ __( 'Ex: View All', 'knight-blocks' ) }
	// 			allowedFormats={ [] }
	// 		/>

	// 		<FontAwesomeIcon icon={ [ 'far', icon ] } className={ `icon-position-${ iconPosition }` } />

	// 		<InspectorControls>
	// 			<PanelBody title={ __( 'Icon', 'knight-blocks' ) }>
	// 				<IconNameControl
	// 					value={ icon }
	// 					onChange={ ( value ) => setAttributes( { icon: value } ) }
	// 				/>

	// 				<RadioControl
	// 					label={ __( 'Position', 'knight-blocks' ) }
	// 					options={ [
	// 						{ label: __( 'Right', 'knight-blocks' ), value: 'right' },
	// 						{ label: __( 'Left', 'knight-blocks' ), value: 'left' },
	// 					] }
	// 					selected={ iconPosition }
	// 					onChange={ ( value ) => setAttributes( { iconPosition: value } ) }
	// 				/>
	// 			</PanelBody>
	// 		</InspectorControls>

	// 	</Fragment>
	// );
}
