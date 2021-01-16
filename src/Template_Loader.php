<?php
/**
 * Template handling
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Template loader
 *
 * This is separate from template PART loading, which can be found in the
 * helper functions.
 *
 * @since 1.0.0
 */
class Template_Loader {

	/**
	 * Hook things in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'template_include', [ __CLASS__, 'set_template' ] );
	}

	/**
	 * Loads the correct template file for the event single/archive
	 *
	 * Templates are in the 'templates' folder. Full Score Events looks for
	 * theme overrides in /%theme%/full-score-events/.
	 *
	 * @see WooCommerce's WC_Template_Loader->template_loader()
	 *
	 * @param  string $template  Template to load.
	 * @return string
	 *
	 * @since  1.0.0
	 */
	public static function set_template( $template ) {

		if ( is_embed() ) {
			return $template;
		}

		if ( is_event() ) {
			$name = 'single-event';
		} elseif ( is_event_archive() ) {
			$name = 'archive-event';
		} else {
			return $template;
		}

		$override = locate_plugin_template( $name );

		return $override ?: $template;
	}
}
