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
	 * CSS/JS asset handle
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	const ASSET_HANDLE = 'full-score-events-public';

	/**
	 * Hook things in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'template_include', [ __CLASS__, 'set_template' ] );
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
		add_action( 'after_setup_theme', [ __CLASS__, 'add_image_sizes' ] );
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

	/**
	 * Enqueue front-end scripts/styles
	 *
	 * @since 1.0.0
	 */
	public static function enqueue_scripts() {
		$build_dir = FULL_SCORE_EVENTS_DIR . 'build';
		$build_url = FULL_SCORE_EVENTS_URL . 'build';

		// Register CSS.
		wp_enqueue_style(
			self::ASSET_HANDLE,
			"{$build_url}/public.css",
			[],
			filemtime( "{$build_dir}/public.css" )
		);
	}

	/**
	 * Register custom image sizes
	 *
	 * @since 1.0.0
	 */
	public static function add_image_sizes() {
		add_image_size( 'fse-banner', 1440, 440, true );
	}
}
