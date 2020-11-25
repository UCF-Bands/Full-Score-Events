<?php
/**
 * Editor blocks handler
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
 * Block loading and asset handling
 *
 * @since 1.0.0
 */
class Blocks {

	/**
	 * Block editor CSS/JS asset handle
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const EDITOR_ASSET_HANDLE = 'full-score-events-block-editor';

	/**
	 * Block front end + editor CSS handle
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const ASSET_HANDLE = 'full-score-events-blocks';

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', [ __CLASS__, 'do_asset_registration' ] );

		new Block( 'taco' );
	}

	/**
	 * Fire off CPT registrations
	 *
	 * @since 1.0.0
	 */
	public static function do_asset_registration() {
		$build_dir = FULL_SCORE_EVENTS_DIR . 'build';
		$build_url = FULL_SCORE_EVENTS_URL . 'build';
		$asset     = require "$build_dir/blocks.asset.php";

		// Register block JS.
		wp_register_script(
			self::EDITOR_ASSET_HANDLE,
			"$build_url/blocks.js",
			$asset['dependencies'],
			$asset['version'],
			true
		);

		// Register editor-specific block styles.
		wp_register_style(
			self::EDITOR_ASSET_HANDLE,
			"$build_url/blocks.css",
			[],
			filemtime( "$build_dir/blocks.css" )
		);

		// Register front-end + editor block styles.
		wp_register_style(
			self::ASSET_HANDLE,
			"$build_url/style-blocks.css",
			[],
			filemtime( "$build_dir/style-blocks.css" )
		);
	}
}
