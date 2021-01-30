<?php
/**
 * Ensemble + taxonomy functionality handler
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
 * Ensemble registration and general handling
 *
 * @since 1.0.0
 */
class Ensembles extends Taxonomy {

	/**
	 * Taxonomy key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const TAX_KEY = 'fse_ensemble';

	/**
	 * Associated post types
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	const POST_TYPES = [
		Programs::CPT_KEY,
		Schedules::CPT_KEY,
		Events::CPT_KEY,
	];

	/**
	 * Get general taxonomy label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_label() {
		return __( 'Ensemble', 'full-score-events' );
	}

	/**
	 * Get the plural version of the general taxonomy label
	 *
	 * @since 1.0.0
	 */
	public function get_plural_label() {
		return __( 'Ensembles', 'full-score-events' );
	}

	/**
	 * Get non-default post type args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_tax_args() {

		$labels = [
			'name'                       => $this->get_plural_label(),
			'singular_name'              => $this->get_label(),
			'menu_name'                  => $this->get_plural_label(),
			'all_items'                  => __( 'All Ensembles', 'full-score-events' ),
			'parent_item'                => __( 'Parent Ensemble', 'full-score-events' ),
			'parent_item_colon'          => __( 'Parent Ensemble:', 'full-score-events' ),
			'new_item_name'              => __( 'New Ensemble Name', 'full-score-events' ),
			'add_new_item'               => __( 'Add New Ensemble', 'full-score-events' ),
			'edit_item'                  => __( 'Edit Ensemble', 'full-score-events' ),
			'update_item'                => __( 'Update Ensemble', 'full-score-events' ),
			'view_item'                  => __( 'View Ensemble', 'full-score-events' ),
			'separate_items_with_commas' => __( 'Separate sample types with commas', 'full-score-events' ),
			'add_or_remove_items'        => __( 'Add or remove sample types', 'full-score-events' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'full-score-events' ),
			'popular_items'              => __( 'Popular Ensembles', 'full-score-events' ),
			'search_items'               => __( 'Search Ensembles', 'full-score-events' ),
			'not_found'                  => __( 'Not Found', 'full-score-events' ),
			'no_terms'                   => __( 'No sample types', 'full-score-events' ),
			'items_list'                 => __( 'Ensembles list', 'full-score-events' ),
			'items_list_navigation'      => __( 'Ensembles list navigation', 'full-score-events' ),
		];

		$rewrite = [
			'slug'         => 'ensemble',
			'with_front'   => false,
			'hierarchical' => true,
		];

		return [
			'labels'            => $labels,
			'hierarchical'      => true,
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
