<?php
/**
 * Taxonomy registration handler
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
 * Taxonomy registration and handling
 *
 * @since 1.0.0
 */
class Taxonomies {

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', [ __CLASS__, 'do_registration' ] );
		add_action( 'full_score_events_activate', [ __CLASS__, 'do_registration' ] );
	}

	/**
	 * Fire off taxonomy registrations
	 *
	 * @since 1.0.0
	 */
	public static function do_registration() {
		register_taxonomy(
			Plugin::SAMPLE_KEY,
			[ Plugin::SAMPLE_KEY ],
			self::get_sample_type_args()
		);
	}

	/**
	 * Get sample taxonomy args
	 *
	 * @return array "fa_department" taxonomy args
	 *
	 * @todo   Delete this sample (and potentially the whole handler class).
	 * @see    https://generatewp.com/taxonomy/
	 * @since  1.0.0
	 */
	public static function get_sample_type_args() {

		$labels = [
			'name'                       => _x( 'Sample Types', 'Taxonomy General Name', 'full-score-events' ),
			'singular_name'              => _x( 'Sample Type', 'Taxonomy Singular Name', 'full-score-events' ),
			'menu_name'                  => __( 'Sample Types', 'full-score-events' ),
			'all_items'                  => __( 'All Sample Types', 'full-score-events' ),
			'parent_item'                => __( 'Parent Sample Type', 'full-score-events' ),
			'parent_item_colon'          => __( 'Parent Sample Type:', 'full-score-events' ),
			'new_item_name'              => __( 'New Sample Type Name', 'full-score-events' ),
			'add_new_item'               => __( 'Add New Sample Type', 'full-score-events' ),
			'edit_item'                  => __( 'Edit Sample Type', 'full-score-events' ),
			'update_item'                => __( 'Update Sample Type', 'full-score-events' ),
			'view_item'                  => __( 'View Sample Type', 'full-score-events' ),
			'separate_items_with_commas' => __( 'Separate sample types with commas', 'full-score-events' ),
			'add_or_remove_items'        => __( 'Add or remove sample types', 'full-score-events' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'full-score-events' ),
			'popular_items'              => __( 'Popular Sample Types', 'full-score-events' ),
			'search_items'               => __( 'Search Sample Types', 'full-score-events' ),
			'not_found'                  => __( 'Not Found', 'full-score-events' ),
			'no_terms'                   => __( 'No sample types', 'full-score-events' ),
			'items_list'                 => __( 'Sample types list', 'full-score-events' ),
			'items_list_navigation'      => __( 'Sample types list navigation', 'full-score-events' ),
		];

		$rewrite = [
			'slug'         => 'sample-type',
			'with_front'   => true,
			'hierarchical' => false,
		];

		return [
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
			'rewrite'           => $rewrite,
			'show_in_rest'      => true,
		];
	}
}
