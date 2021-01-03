<?php
/**
 * Settings page handler
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
 * General plugin settings page handler
 *
 * @since 1.0.0
 */
class Settings {

	/**
	 * Page/menu slug
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	private static $page_slug = 'full-score-events';

	/**
	 * Settings option group key
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	private static $group = 'fse';

	/**
	 * Settings section key
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	private static $section = 'fse_main';

	/**
	 * Google API key option name
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	private static $key_google = 'fse_api_google';

	/**
	 * Hook our sections/processors in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_init', [ __CLASS__, 'add_settings' ] );
		add_action( 'admin_menu', [ __CLASS__, 'add_page' ] );
	}

	/**
	 * Register custom settings
	 *
	 * @since 1.0.0
	 */
	public static function add_settings() {

		add_settings_section(
			self::$section,
			null,
			'__return_null',
			self::$page_slug
		);

		add_settings_field(
			self::$key_google,
			__( 'Google API Key', 'full-score-events' ),
			[ __CLASS__, 'do_google_setting' ],
			self::$page_slug,
			self::$section
		);
		register_setting( self::$group, self::$key_google );
	}

	/**
	 * Render Google API setting
	 *
	 * @since 1.0.0
	 */
	public static function do_google_setting() {
		self::do_text_field( self::$key_google );
		echo '<p>' . sprintf(
			// Translators: Enable the %sMaps Embed% and %Places% APIs (settings).
			esc_html__( 'Create an API key credential for this site on %1$sGoogle Cloud Platform%2$s with: %3$sMaps Embed%4$s, %5$sPlaces%6$s.', 'full-score-events' ),
			'<a href="https://console.cloud.google.com/" target="_blank" rel="nofollow">',
			'</a>',
			'<a href="https://console.cloud.google.com/marketplace/product/google/maps-embed-backend.googleapis.com" target="_blank" rel="nofollow">',
			'</a>',
			'<a href="https://console.cloud.google.com/marketplace/product/google/places-backend.googleapis.com" target="_blank" rel="nofollow">',
			'</a>'
		) . '</p>';
	}

	/**
	 * Register options page
	 *
	 * @since 1.0.0
	 */
	public static function add_page() {
		add_options_page(
			__( 'Full Score Events Settings', 'full-score-events' ),
			__( 'Full Score Events', 'full-score-events' ),
			'manage_options',
			self::$page_slug,
			[ __CLASS__, 'do_page' ]
		);
	}

	/**
	 * Render options page contents
	 *
	 * @since 1.0.
	 */
	public static function do_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Full Score Events Settings', 'full-score-events' ); ?></h1>

			<form action="options.php" method="post">
				<?php
				settings_fields( self::$group );
				do_settings_sections( self::$page_slug );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Output text input
	 *
	 * @param string $key Option name/key.
	 * @since 1.0.0
	 */
	private static function do_text_field( $key ) {
		?>
		<input
			type="text"
			name="<?php echo esc_attr( $key ); ?>"
			id="<?php echo esc_attr( $key ); ?>"
			value="<?php echo esc_attr( get_option( $key ) ); ?>"
			class="regular-text"
		>
		<?php
	}

	/**
	 * Get setting value
	 *
	 * Usage example: Settings::get( 'google' )
	 *
	 * @param  string $option Setting key.
	 * @return mixed
	 *
	 * @since 1.0.0
	 */
	public static function get( $option ) {
		$option = "key_$option";
		return get_option( self::$$option );
	}
}
