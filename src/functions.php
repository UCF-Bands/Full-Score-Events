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
 * @since  1.0.0
 * @see    https://github.com/WordPress/WordPress-Coding-Standards/wiki/Fixing-errors-for-input-data
 *
 * @param  string $key  $_GET superglobal key.
 * @return mixed
 */
function get( $key ) {
	return isset( $_GET[ $key ] ) ? sanitize_text_field( wp_unslash( $_GET[ $key ] ) ) : null;
}

/**
 * Returns a posted value
 *
 * Nonce verification should happen before this.
 *
 * @since 1.0.0
 * @see   https://github.com/WordPress/WordPress-Coding-Standards/wiki/Fixing-errors-for-input-data
 *
 * @param  string $key  $_POST superglobal key.
 * @return mixed
 */
function postval( $key ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Missing
	return isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : null;
}

/**
 * Break array into string of attributes
 *
 * @since 1.0.0
 *
 * @param  array  $attrs   Attributes (keys) and values.
 * @param  string $prefix  Prefix for data attributes (ex: "data-").
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
 * @since 1.0.0
 *
 * @param  array  $attrs   Attributes and their values.
 * @param  string $prefix  A prefix for data attributes (ex: "data-").
 */
function do_attrs( $attrs, $prefix = '' ) {
	echo get_attrs( $attrs, $prefix ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Attribute building helper, but all items go to "class" arg
 *
 * @since 1.0.0
 *
 * @return string
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
 * Custom kses allowed HTML for "inlined" entities.
 *
 * @since 1.0.0
 *
 * @return array  Allowed HTML entities/attributes.
 */
function get_allowed_inline_html() {
	return [
		'a'      => [
			'href'  => [],
			'rel'   => [],
			'title' => [],
		],
		'b'      => [],
		'strong' => [],
		'i'      => [],
		'em'     => [],
		'code'   => [],
	];
}

/**
 * Configure "allowed inline HTML" message for block editor.
 *
 * @since 1.0.0
 *
 * @param  array $object  Data to be localized in JS object.
 * @return array $object  Data to be localized + "allowed inline HTML" help text.
 */
function set_blocks_js_allowed_inline_html_help( $object ) {

	$object['allowedInlineHTML'] = sprintf(
		// Translators: Allowed HTML: %s.
		__( 'Allowed HTML: %s', 'full-score-events' ),
		implode( ', ', array_keys( get_allowed_inline_html() ) )
	);

	return $object;
}
add_filter( 'full_score_events_editor_js_object', __NAMESPACE__ . '\set_blocks_js_allowed_inline_html_help' );

/**
 * Locate a template part in the theme, then fall back to plugin.
 *
 * @since 1.0.0
 *
 * @param  string $slug  Template slug (excluding .php).
 * @param  string $name  Template file name (excluding .php).
 * @return string        Template path.
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
 * @since 1.0.0
 *
 * @param string $slug  Template slug (excluding .php).
 * @param string $name  Template part name (excluding .php).
 * @param array  $args  Template arguments (extracted to vars).
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
 * @since 1.0.0
 *
 * @param  string  $name     Block name.
 * @param  integer $post_id  Post to search.
 * @return array             Parsed block array, if exists.
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
 * @since 1.0.0
 *
 * @param string $name  Block template part name (excluding .php).
 * @param array  $args  Template arguments (extracted to vars).
 */
function get_block_template( $name, $args = [] ) {
	ob_start();

	/**
	 * Hook: full_score_events_before_block
	 *
	 * @param string $name Block template part name (excluding .php).
	 * @param array  $args Template arguments (extracted to vars).
	 */
	do_action( 'full_score_events_before_block', $name, $args );

	get_plugin_template( "block/$name", '', $args );

	/**
	 * Hook: full_score_events_after_block
	 *
	 * @param string $name Block template part name (excluding .php).
	 * @param array  $args Template arguments (extracted to vars).
	 */
	do_action( 'full_score_events_after_block', $name, $args );

	return ob_get_clean();
}

/**
 * Wrapper for edit_posts capability check
 *
 * @since 1.0.0
 *
 * @return bool
 */
function get_can_user_edit_posts() {
	return current_user_can( 'edit_posts' );
}

/**
 * Add SVG to allowed MIMEs
 *
 * @since 1.0.0
 *
 * @param  array $mimes  Allowed MIME types.
 * @return array $mimes
 */
function add_allowed_mimes( $mimes ) {
	$mimes['svg'] = 'image/svg';
	return $mimes;
}
add_filter( 'upload_mimes', __NAMESPACE__ . '\\add_allowed_mimes' );


/**
 * Get the contents of an icon SVG
 *
 * @since 1.0.0
 *
 * @param  string $name  File name of icon in icons/.
 * @return string
 */
function get_icon( $name ) {
	return file_get_contents( FULL_SCORE_EVENTS_DIR . "src/icons/{$name}.svg" ); // phpcs:ignore
}

/**
 * Output an SVG icon
 *
 * @since 1.0.0
 *
 * @param string $name  Icon file name.
 */
function do_icon( $name ) {
	echo get_icon( $name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Do a basic permissions check on viewing a post
 *
 * @since 1.0.0
 *
 * @param  integer $post_id  Post ID to check against.
 * @return boolean
 */
function get_can_view_post( $post_id ) {
	$status = get_post_status( $post_id );
	return 'publish' === $status || ( 'private' === $status && get_can_user_edit_posts() );
}

/**
 * Get a location
 *
 * Make sure the post exists and it's a location, then get its object.
 *
 * @since 1.0.0
 *
 * @param  integer $post_id  Post ID to check.
 * @return boolean|Location
 */
function get_location( $post_id ) {
	return $post_id && get_can_view_post( $post_id ) ? new Location( $post_id ) : false;
}

/**
 * Get a staff member
 *
 * Make sure the post exists and it's a staff member, then get its object.
 *
 * @since 1.0.0
 *
 * @param  integer $post_id  Post ID to check.
 * @return boolean|Staff_Member
 */
function get_staff_member( $post_id ) {
	return $post_id && get_can_view_post( $post_id ) ? new Staff_Member( $post_id ) : false;
}

/**
 * Is this an event single?
 *
 * @since 1.0.0
 *
 * @return boolean
 */
function is_event() {
	return is_singular( Events::CPT_KEY );
}

/**
 * Is this an event archive?
 *
 * @since 1.0.0
 *
 * @return boolean
 */
function is_event_archive() {
	return is_post_type_archive( Events::CPT_KEY );
}
