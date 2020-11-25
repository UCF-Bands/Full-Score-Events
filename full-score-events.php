<?php
/**
 * Plugin Name: Full Score Events
 * Plugin URI: https://wordpress.org/plugins/full-score-events
 * Description: Event, schedule, and concerpt program management and listing for bands
 * Author: JordanPak
 * Author URI: https://jordanpak.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: full-score-events
 *
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get autoloader and helper functions.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/functions.php';

/**
 * Plugin wrapper
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Spin up plugin
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->set_constants();
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'full_score_events_activate', [ $this, 'init' ], 5 );
		add_action( 'full_score_events_activate', 'flush_rewrite_rules' );
		add_action( 'full_score_events_deactivate', 'flush_rewrite_rules' );
	}

	/**
	 * Set constants
	 *
	 * @since 1.0.0
	 */
	private function set_constants() {
		define( 'FULL_SCORE_EVENTS_VERSION', '1.0.0' );
		define( 'FULL_SCORE_EVENTS_DIR', plugin_dir_path( __FILE__ ) );
		define( 'FULL_SCORE_EVENTS_URL', plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Do block and asset registration
	 *
	 * @since 1.0.0
	 */
	public function init() {
		new Schedules();
		new Blocks();
	}

	/**
	 * Handle activation tasks
	 *
	 * @since 1.0.0
	 */
	public function do_activate() {
		do_action( 'full_score_events_activate' );
	}

	/**
	 * Handle deactivation tasks
	 *
	 * @since 1.0.0
	 */
	public function do_deactivate() {
		do_action( 'full_score_events_deactivate' );
	}
}

// Instantiate plugin wrapper class.
$full_score_events_plugin = new Plugin();

// Register activation/deactivation stuff.
register_activation_hook( __FILE__, [ $full_score_events_plugin, 'do_activate' ] );
register_deactivation_hook( __FILE__, [ $full_score_events_plugin, 'do_deactivate' ] );
