<?php
/**
 * Customizer handling
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

use WP_Customize_Media_Control;

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
	 * @var   string
	 * @since 1.0.0
	 */
	private static $prefix = 'fse';

	/**
	 * Hook everything in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'add_section' ] );
	}

	/**
	 * Add customizer section, settings, and controls
	 *
	 * @param WP_Customize_Manager $wp_customize  Customizer object.
	 * @since 1.0.0
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
			new WP_Customize_Media_Control(
				$wp_customize,
				"{$this::$prefix}_featured_background",
				[
					'label'    => __( 'Featured Events Background', 'full-score-events' ),
					'settings' => "{$this::$prefix}_featured_background",
					'section'  => $section,
				]
			)
		);
	}

	/**
	 * Get the value of a customizer setting
	 *
	 * @param  string $setting  Name of setting (without prefix).
	 * @param  mixed  $default  Default value fallback.
	 * @return mixed
	 *
	 * @since  1.0.0
	 */
	public static function get( $setting, $default = false ) {
		return get_theme_mod( self::$prefix . "_{$setting}", $default );
	}
}
