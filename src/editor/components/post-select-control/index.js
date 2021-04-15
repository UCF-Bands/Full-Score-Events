/**
 * Post selection control
 *
 * @since 1.0.0
 */

import AsyncSelect from 'react-select/async';

import { __, sprintf } from '@wordpress/i18n';
import { BaseControl, Button } from '@wordpress/components';

import getApiOptions from '../../util/get-api-options';

import './index.scss';

const PostSelectControl = ( {
	label,
	selectLabel,
	postType,
	postId,
	post,
	setPostId,
} ) => (
	<BaseControl
		className={ `fse-${ postType }-control fse-post-select-control` }
		id={ `fse-${ postType }-select` }
		label={ label }
	>
		<AsyncSelect
			name="kb-post-select"
			value={
				post
					? {
							label: post.title.rendered,
							value: postId,
					  }
					: {}
			}
			onChange={ ( option ) => setPostId( option.value ) }
			loadOptions={ ( inputValue, callback ) =>
				getApiOptions( postType, inputValue, callback )
			}
			placeholder={ sprintf(
				// Translators: Start typing the name of a %s…
				__( 'Start typing the name of a %s…', 'full-score-events' ),
				selectLabel
			) }
			noOptionsMessage={ () =>
				sprintf(
					// Translators: No options. Start typing the name of a %s
					__(
						'No options. Start typing the name of a %s',
						'full-score-events'
					),
					selectLabel
				)
			}
		/>
		{ post && (
			<Button
				className={ `fse-${ postType }-remove fse-post-select-remove` }
				isLink
				isDestructive
				onClick={ () => setPostId( 0 ) }
			>
				{ __( 'Remove', 'full-score-events' ) }
			</Button>
		) }
	</BaseControl>
);

export default PostSelectControl;
