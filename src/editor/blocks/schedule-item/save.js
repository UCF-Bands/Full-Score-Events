/**
 * Schedule item block save
 *
 * No blockProps so we can do custom wrapping in dynamic block.
 *
 * @since 1.0.0
 */

import { InnerBlocks } from '@wordpress/block-editor';

export default function save() {
	return <InnerBlocks.Content />;
}
