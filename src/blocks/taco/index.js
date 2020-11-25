/**
 * Taco block
 *
 * Look at this test bro.
 *
 * @since   1.0.0
 */

import { registerBlockType } from '@wordpress/blocks';

import './style.css';
import './index.css';

registerBlockType( 'full-score-events/taco', {
	title: 'Taco',
	icon: 'smiley',
	category: 'design',
	edit: () => <div>Hola, mundo! #TacoBlock</div>,
	save: () => <div>Hola, mundo! #TacoBlock</div>,
} );
