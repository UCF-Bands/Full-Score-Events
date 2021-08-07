<?php
/**
 * Customizer handling
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer handling class
 *
 * @since 1.0.0
 */
class Customizer {

	/**
	 * Customizer control/setting prefix
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private static $prefix = 'fse';

	/**
	 * Settings used for inline custom CSS property styles
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	private static $style_settings = [
		'featured_background',
		'featured_background_overlay',
		'featured_color',
	];

	/**
	 * Hook everything in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'add_section' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'do_styles' ] );
		add_action( 'customize_save_after', [ $this, 'remove_styles_transient' ] );
		add_action( 'switch_theme', [ $this, 'remove_styles_transient' ] );
	}

	/**
	 * Add customizer section, settings, and controls
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize  Customizer object.
	 */
	public function add_section( $wp_customize ) {

		$section = "{$this::$prefix}_main";

		// Add main section.
		$wp_customize->add_section(
			$section,
			[
				'title' => __( 'Events', 'full-score-events' ),
			]
		);

		// Excerpt length.
		$wp_customize->add_setting( "{$this::$prefix}_excerpt_length" );
		$wp_customize->add_control(
			"{$this::$prefix}_excerpt_length",
			[
				'label'   => __( 'Event Excerpt Length (Words)', 'full-score-events' ),
				'type'    => 'number',
				'section' => $section,
			]
		);

		// Featured events title.
		$wp_customize->add_setting(
			"{$this::$prefix}_featured_title",
			[
				'default' => __( 'Featured Events', 'full-score-events' ),
			]
		);
		$wp_customize->add_control(
			"{$this::$prefix}_featured_title",
			[
				'label'   => __( 'Featured Events Title', 'full-score-events' ),
				'section' => $section,
			]
		);

		// Featured events body.
		$wp_customize->add_setting( "{$this::$prefix}_featured_body" );
		$wp_customize->add_control(
			"{$this::$prefix}_featured_body",
			[
				'label'   => __( 'Featured Events Body', 'full-score-events' ),
				'type'    => 'textarea',
				'section' => $section,
			]
		);

		// Featured events background.
		$wp_customize->add_setting( "{$this::$prefix}_featured_background" );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				"{$this::$prefix}_featured_background",
				[
					'label'    => __( 'Featured Events Background Color', 'full-score-events' ),
					'settings' => "{$this::$prefix}_featured_background",
					'section'  => $section,
				]
			)
		);

		$wp_customize->add_setting( "{$this::$prefix}_featured_background_image" );
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				"{$this::$prefix}_featured_background_image",
				[
					'label'    => __( 'Featured Events Background Image', 'full-score-events' ),
					'settings' => "{$this::$prefix}_featured_background_image",
					'section'  => $section,
				]
			)
		);

		$wp_customize->add_setting( "{$this::$prefix}_featured_background_overlay" );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				"{$this::$prefix}_featured_background_overlay",
				[
					'label'    => __( 'Featured Events Background Image Overlay', 'full-score-events' ),
					'settings' => "{$this::$prefix}_featured_background_overlay",
					'section'  => $section,
				]
			)
		);

		// Featured events text color.
		$wp_customize->add_setting( "{$this::$prefix}_featured_color" );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				"{$this::$prefix}_featured_color",
				[
					'label'    => __( 'Featured Events Text Color', 'full-score-events' ),
					'settings' => "{$this::$prefix}_featured_color",
					'section'  => $section,
				]
			)
		);

		do_action(
			'full_score_events_after_customizer_events_controls',
			$wp_customize,
			$section
		);
	}

	/**
	 * Output and/or build :root custom properties
	 *
	 * @since 1.0.0
	 */
	public function do_styles() {

		$styles = get_transient( 'fse_global_styles' );

		// Check if we need to re-build styles.
		if ( false === $styles || is_customize_preview() ) {

			$styles = [];

			// Iterate over each setting, reformatting its name and adding its
			// value if set.
			foreach ( $this::$style_settings as $setting ) {
				$value = $this::get( $setting );

				if ( ! $value ) {
					continue;
				}

				$setting  = str_replace( '_', '-', $setting );
				$styles[] = "\t--fse-{$setting}: {$value};\n";
			}

			// No values found--set cache to empty.
			if ( ! $styles ) {
				set_transient( 'fse_global_styles', [] );
				return;
			}

			// Add :root selector and set cache.
			array_unshift( $styles, ":root {\n" );
			$styles[] = '}';
			$styles   = implode( '', $styles );

			set_transient( 'fse_global_styles', $styles );

			// Cache found with no styles.
		} elseif ( ! $styles ) {
			return;
		}

		wp_register_style( 'fse-global', false, [], FULL_SCORE_EVENTS_VERSION );
		wp_add_inline_style( 'fse-global', $styles );
		wp_enqueue_style( 'fse-global' );
	}

	/**
	 * Clear out custom inline properties cache
	 *
	 * @since 1.0.0
	 */
	public static function remove_styles_transient() {
		delete_transient( 'fse_global_styles' );
	}

	/**
	 * Get the value of a customizer setting
	 *
	 * @since  1.0.0
	 *
	 * @param  string $setting  Name of setting (without prefix).
	 * @param  mixed  $default  Default value fallback.
	 * @return mixed
	 */
	public static function get( $setting, $default = false ) {
		return get_theme_mod( self::$prefix . "_{$setting}", $default );
	}
}
