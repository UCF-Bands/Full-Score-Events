<?php
/**
 * Misc. helper functions
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

/**
 * Returns a $_GET value
 *
 * @param  string $key $_GET superglobal key.
 * @return mixed
 * @see    https://github.com/WordPress/WordPress-Coding-Standards/wiki/Fixing-errors-for-input-data
 * @since  1.0.0
 */
function get( $key ) {
	return isset( $_GET[ $key ] ) ? sanitize_text_field( wp_unslash( $_GET[ $key ] ) ) : null;
}

/**
 * Get a plugin template
 *
 * @param string $name  Template part name (excluding .php).
 * @param array  $args  Template arguments (extracted to vars).
 *
 * @since 1.0.0
 */
function get_plugin_template( $name, $args = [] ) {

	// Maker vars for all the args.
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	}

	// Set the path and ensure the template is there.
	$template = FULL_SCORE_EVENTS_DIR . "src/templates/{$name}.php";

	if ( ! file_exists( $template ) ) {
		return;
	}

	// Load the template part.
	include $template;
}

/**
 * Add SVG to allowed MIMEs
 *
 * @param  array $mimes  Allowed MIME types.
 * @return array $mimes
 *
 * @since 1.0.0
 */
function add_allowed_mimes( $mimes ) {
	$mimes['svg'] = 'image/svg';
	return $mimes;
}
add_filter( 'upload_mimes', __NAMESPACE__ . '\\add_allowed_mimes' );
