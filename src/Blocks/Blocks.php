<?php
/**
 * Editor blocks handler
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events\Blocks;

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
	const EDITOR_ASSET_HANDLE = 'full-score-events-editor';

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
		add_action( 'enqueue_block_editor_assets', [ __CLASS__, 'enqueue_editor_assets' ] );

		new Block( 'taco' );

		// Dynamic/templated blocks.
		new Post_Block( 'schedule' );
		new Schedule_Item();
		new Schedule_Items();

		// new Zombie_Schedule_Edit(); This is just a placeholder since we have that Gutenberg issue.
	}

	/**
	 * Register assets for blocks/editor to use
	 *
	 * @since 1.0.0
	 */
	public static function do_asset_registration() {
		$build_dir = FULL_SCORE_EVENTS_DIR . 'build';
		$build_url = FULL_SCORE_EVENTS_URL . 'build';
		$asset     = require "$build_dir/editor.asset.php";

		// Register block JS.
		wp_register_script(
			self::EDITOR_ASSET_HANDLE,
			"$build_url/editor.js",
			$asset['dependencies'],
			$asset['version'],
			true
		);

		// Register editor-specific block styles.
		wp_register_style(
			self::EDITOR_ASSET_HANDLE,
			"$build_url/editor.css",
			[],
			filemtime( "$build_dir/editor.css" )
		);

		// Register front-end + editor block styles.
		wp_register_style(
			self::ASSET_HANDLE,
			"$build_url/style-editor.css",
			[],
			filemtime( "$build_dir/style-editor.css" )
		);
	}

	/**
	 * Enqueue editor assets
	 *
	 * @since 1.0.0
	 */
	public static function enqueue_editor_assets() {

		// Always enqueue editor script/styles since sidebar plugins aren't
		// registered in PHP.
		wp_enqueue_script( self::EDITOR_ASSET_HANDLE );
		wp_enqueue_style( self::EDITOR_ASSET_HANDLE );

		wp_localize_script(
			self::EDITOR_ASSET_HANDLE,
			'fullScoreEventsEditor',
			apply_filters(
				'full_score_events_editor_js_object',
				[
					'currentCPT' => get_post_type(),
				]
			)
		);
	}
}
