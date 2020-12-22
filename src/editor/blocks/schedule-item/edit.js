/**
 * Schedule item block edit
 *
 * @since   1.0.0
 */

import { __ } from '@wordpress/i18n';
import { withSelect } from '@wordpress/data';
import { __experimentalGetSettings } from '@wordpress/date';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { TimePicker } from '@wordpress/components';

const ALLOWED_BLOCKS = [ 'core/paragraph', 'core/list' ];

const BLOCKS_TEMPLATE = [
	[
		'core/paragraph',
		{
			placeholder: __( 'Ex: Kickoff #ChargeOn', 'full-score-events' ),
		},
	],
];

/**
 * Get time format
 *
 * @see https://github.com/WordPress/gutenberg/tree/master/packages/components/src/date-time
 */
const settings = __experimentalGetSettings();

// To know if the current timezone is a 12 hour time with look for an "a" in the time format.
// We also make sure this a is not escaped by a "/".
const is12HourTime = /a(?!\\)/i.test(
	settings.formats.time
		.toLowerCase() // Test only the lower case a
		.replace( /\\\\/g, '' ) // Replace "//" with empty strings
		.split( '' )
		.reverse()
		.join( '' ) // Reverse the string and test for "a" not followed by a slash
);

const edit = withSelect( ( select ) => {
	const previousBlockId = select(
		'core/block-editor'
	).getPreviousBlockClientId();

	return {
		previousBlockAttributes: select(
			'core/block-editor'
		).getBlockAttributes( previousBlockId ),
	};
} )( ( { previousBlockAttributes, attributes, setAttributes } ) => {
	const blockProps = useBlockProps();
	let { dateTime } = attributes;

	// auto-set dateTime by previous block if empty
	if ( ! dateTime && previousBlockAttributes?.dateTime ) {
		dateTime = previousBlockAttributes.dateTime;
	}

	return (
		<div { ...blockProps }>
			<TimePicker
				currentTime={ dateTime }
				onChange={ ( value ) => setAttributes( { dateTime: value } ) }
				is12Hour={ is12HourTime }
			/>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ BLOCKS_TEMPLATE }
			/>
		</div>
	);
} );

export default edit;
