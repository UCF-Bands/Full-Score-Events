/**
 * Program piece block save
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const blockProps = useBlockProps.save(),
		{ title, note, composer, arranger } = attributes;

	return (
		<div { ...blockProps }>
			<RichText.Content
				tagName="h5"
				className="fse-piece-title"
				value={ title }
			/>
			<RichText.Content
				tagName="small"
				className="fse-piece-note"
				value={ note }
			/>

			{ composer && (
				<p className="fse-piece-composer">
					<span className="screen-reader-text">
						{ __( 'Composed by', 'full-score-events' ) }
					</span>
					{ ` ` }
					<RichText.Content
						tagName="span"
						className="fse-piece-composer-name"
						value={ composer }
					/>
				</p>
			) }

			{ arranger && (
				<p className="fse-piece-arranger">
					<span className="fse-arranger-label">
						{ __( 'Arr.', 'full-score-events' ) }
					</span>
					{ ` ` }
					<RichText.Content
						tagName="span"
						className="fse-piece-arranger-name"
						value={ arranger }
					/>
				</p>
			) }
		</div>
	);
}
