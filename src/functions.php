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
 * Break array into string of attributes
 *
 * Has special cases for "class" and "data" keys if their values are arrays, so
 * it's compatible with arrays of data attributes (by using recusion).
 *
 * @param  array  $attrs   Attribute names/values.
 * @param  string $prefix  a prefix for the data attribute (ex: "data-").
 * @return string          Inline string of data attributes.
 */
function get_attrs( $attrs, $prefix = '' ) {

	// Remove initially empty args.
	$attrs = array_filter( $attrs );

	foreach ( $attrs as $attr => $value ) {

		// data- attributes.
		if ( 'data' === $attr && is_array( $value ) ) {
			$attrs[ $attr ] = get_attrs( array_filter( $value ), 'data-' );
			continue;
		}

		// Array of classes.
		if ( 'class' === $attr && is_array( $value ) ) {
			$value = implode( ' ', array_filter( $value ) );
		}

		// Array of classes + all other cases.
		$attrs[ $attr ] = $prefix . $attr . '="' . esc_attr( $value ) . '"';
	}

	return implode( ' ', $attrs );
}

/**
 * Output HTML string off attributes
 *
 * @param  array  $attrs   Attribute names/values.
 * @param  string $prefix  a prefix for the data attribute (ex: "data-").
 */
function do_attrs( $attrs, $prefix = '' ) {
	echo get_attrs( $attrs, $prefix ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Attribute building helper, but all items go to "class" arg
 *
 * @return string
 * @since  1.0.0
 */
function get_attrs_class() {
	return get_attrs( [ 'class' => func_get_args() ] );
}

/**
 * Output class attribute
 *
 * @since 1.0.0
 */
function do_attrs_class() {
	echo get_attrs( [ 'class' => func_get_args() ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Locate a template part in the theme, then fall back to plugin.
 *
 * @param  string $slug  Template slug (excluding .php).
 * @param  string $name  Template file name (excluding .php).
 * @return string        Template path.
 *
 * @since  1.0.0
 */
function locate_plugin_template( $slug, $name = '' ) {

	$template = false;

	if ( $name ) {
		$template = locate_template( "full-score-events/{$slug}-{$name}.php" );

		if ( ! $template ) {
			$fallback = FULL_SCORE_EVENTS_DIR . "src/templates/{$slug}-{$name}.php";
			$template = file_exists( $fallback ) ? $fallback : false;
		}
	}

	// Check for non-named template if there wasn't a named template found.
	if ( ! $template ) {
		$template = locate_template( "full-score-events/{$slug}.php" );
	}

	if ( ! $template ) {
		$fallback = FULL_SCORE_EVENTS_DIR . "src/templates/{$slug}.php";
		$template = file_exists( $fallback ) ? $fallback : false;
	}

	return $template;
}

/**
 * Get a plugin template
 *
 * @param string $slug  Template slug (excluding .php).
 * @param string $name  Template part name (excluding .php).
 * @param array  $args  Template arguments (extracted to vars).
 *
 * @since 1.0.0
 */
function get_plugin_template( $slug, $name = '', $args = [] ) {

	// Make vars for all the args.
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	}

	// Set the path and ensure the template is there.
	$template = locate_plugin_template( $slug, $name );

	if ( $template ) {
		include $template;
	}
}

/**
 * Get the first parsed block of type/name from post content
 *
 * @param  string  $name     Block name.
 * @param  integer $post_id  Post to search.
 * @return array             Parsed block array, if exists.
 *
 * @since  1.0.0
 */
function get_block( $name, $post_id = null ) {

	$post_id = $post_id ?: get_the_ID();

	if ( ! has_block( $name, $post_id ) ) {
		return false;
	}

	$post   = get_post( $post_id );
	$blocks = parse_blocks( $post->post_content );
	$blocks = wp_list_filter( $blocks, [ 'blockName' => $name ] );

	if ( ! $blocks ) {
		return;
	}

	// Always just use one edit block.
	return $blocks[0];
}

/**
 * Get a dynamic block template
 *
 * @param string $name Block template part name (excluding .php).
 * @param array  $args Template arguments (extracted to vars).
 *
 * @since 1.0.0
 */
function get_block_template( $name, $args = [] ) {
	ob_start();
	get_plugin_template( "block/$name", '', $args );
	return ob_get_clean();
}

/**
 * Wrapper for edit_posts capability check
 *
 * @return bool
 * @since  1.0.0
 */
function get_can_user_edit_posts() {
	return current_user_can( 'edit_posts' );
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


/**
 * Get the contents of an icon SVG
 *
 * @param  string $name  File name of icon in icons/.
 * @return string
 *
 * @since 1.0.0
 */
function get_icon( $name ) {
	return file_get_contents( FULL_SCORE_EVENTS_DIR . "src/icons/{$name}.svg" ); // phpcs:ignore
}

/**
 * Output an SVG icon
 *
 * @param string $name  Icon file name.
 * @since 1.0.0
 */
function do_icon( $name ) {
	echo get_icon( $name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Is this an event single?
 *
 * @return boolean
 * @since  1.0.0
 */
function is_event() {
	return is_singular( Events::CPT_KEY );
}

/**
 * Is this an event archive?
 *
 * @return boolean
 * @since  1.0.0
 */
function is_event_archive() {
	return is_post_type_archive( Events::CPT_KEY );
}

/**
 * Output opening main wrapper tag
 *
 * @since 1.0.0
 */
function output_content_wrapper() {
	get_plugin_template( 'global/wrapper-open' );
}

/**
 * Output closing main wrapper tag
 *
 * @since 1.0.0
 */
function output_content_wrapper_close() {
	get_plugin_template( 'global/wrapper-close' );
}

/**
 * Output archive header
 *
 * @since 1.0.0
 */
function output_archive_header() {

	if ( is_archive() ) {
		get_plugin_template( 'archive-header' );
	}
}
