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

// Get autoloader and helper + template functions.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/functions.php';
require_once __DIR__ . '/src/template-functions.php';

/**
 * Plugin wrapper
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * The single instance of this class
	 *
	 * @since 1.0.0
	 * @var   Plugin
	 */
	protected static $instance;

	/**
	 * Schedules handler
	 *
	 * @since 1.0.0
	 * @var   Schedules
	 */
	public $schedules;

	/**
	 * Programs handler
	 *
	 * @since 1.0.0
	 * @var   Programs
	 */
	public $programs;

	/**
	 * Locations handler
	 *
	 * @since 1.0.0
	 * @var   Locations
	 */
	public $locations;

	/**
	 * Ensembles handler
	 *
	 * @since 1.0.0
	 * @var   Ensembles
	 */
	public $ensembles;

	/**
	 * Seasons handler
	 *
	 * @since 1.0.0
	 * @var   Seasons
	 */
	public $seasons;

	/**
	 * Events handler
	 *
	 * @since 1.0.0
	 * @var   Events
	 */
	public $events;

	/**
	 * Blocks handler
	 *
	 * @since 1.0.0
	 * @var   Customizer
	 */
	public $blocks;

	/**
	 * Staff handler
	 *
	 * @since 1.0.0
	 * @var   Staff
	 */
	public $staff;

	/**
	 * Users handler
	 *
	 * @since 1.0.0
	 * @var   Users
	 */
	public $users;

	/**
	 * Customizer handler
	 *
	 * @since 1.0.0
	 * @var   Customizer
	 */
	public $customizer;

	/**
	 * Settings handler
	 *
	 * @since 1.0.0
	 * @var   Settings
	 */
	public $settings;

	/**
	 * Template loading handler
	 *
	 * False if not a front end request.
	 *
	 * @since 1.0.0
	 * @var   Template_Loader|boolean
	 */
	public $template_loader = false;

	/**
	 * Template hooks handler
	 *
	 * False if not a front end request.
	 *
	 * @since 1.0.0
	 * @var   Template_Hooks|boolean
	 */
	public $template_hooks = false;

	/**
	 * Get main plugin instance.
	 *
	 * @since 1.0.0
	 * @see   instance()
	 *
	 * @return Plugin
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

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
		$this->schedules  = new Schedules();
		$this->programs   = new Programs();
		$this->locations  = new Locations();
		$this->ensembles  = new Ensembles();
		$this->seasons    = new Seasons();
		$this->events     = new Events();
		$this->blocks     = new Blocks\Blocks();
		$this->staff      = new Staff();
		$this->users      = new Users();
		$this->customizer = new Customizer();
		$this->settings   = new Settings();

		if ( $this->is_request( 'frontend' ) ) {
			$this->template_loader = new Template_Loader();
			$this->template_hooks  = new Template_Hooks();
		}

		do_action( 'full_score_events_loaded' );
	}

	/**
	 * What type of request is this?
	 *
	 * @since 1.0.0
	 * @see   WooCommerce's WooCommerce->is_request()
	 *
	 * @param  string $type  admin, ajax, cron or frontend.
	 * @return boolean
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();

			case 'ajax':
				return defined( 'DOING_AJAX' );

			case 'cron':
				return defined( 'DOING_CRON' );

			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
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

/**
 * Get instance of main plugin class
 *
 * @since 1.0.0
 *
 * @return Plugin
 */
function instance() {
	return Plugin::instance();
}

// Instantiate plugin wrapper class.
$full_score_events_plugin = instance();

// Register activation/deactivation stuff.
register_activation_hook( __FILE__, [ $full_score_events_plugin, 'do_activate' ] );
register_deactivation_hook( __FILE__, [ $full_score_events_plugin, 'do_deactivate' ] );
