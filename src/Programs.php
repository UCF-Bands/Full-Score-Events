<?php
/**
 * Program post type + functionality handler
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
 * Program CPT registration and general handling
 *
 * @todo add date meta (for archiving?)
 *
 * @since 1.0.0
 */
class Programs extends Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const CPT_KEY = 'fse_program';

	/**
	 * Object class to be used for indivudal instances of the post type
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $singular_class = 'Program';

	/**
	 * Flag for global post variable in look
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $loop_global_name = 'program';

	/**
	 * Get general post type label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_label() {
		return __( 'Program', 'full-score-events' );
	}

	/**
	 * Get plural post type label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_plural_label() {
		return __( 'Programs', 'full-score-events' );
	}

	/**
	 * Get non-default post type args
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_cpt_args() {
		return [
			'description'         => __( 'A performance program.', 'full-score-events' ),
			'labels'              => [
				'archives'              => __( 'Program Archives', 'full-score-events' ),
				'attributes'            => __( 'Program Attributes', 'full-score-events' ),
				'parent_item_colon'     => __( 'Parent Program:', 'full-score-events' ),
				'all_items'             => __( 'All Programs', 'full-score-events' ),
				'add_new_item'          => __( 'Add New Program', 'full-score-events' ),
				'new_item'              => __( 'New Program', 'full-score-events' ),
				'edit_item'             => __( 'Edit Program', 'full-score-events' ),
				'update_item'           => __( 'Update Program', 'full-score-events' ),
				'view_item'             => __( 'View Program', 'full-score-events' ),
				'view_items'            => __( 'View Programs', 'full-score-events' ),
				'search_items'          => __( 'Search Program', 'full-score-events' ),
				'insert_into_item'      => __( 'Insert into program', 'full-score-events' ),
				'uploaded_to_this_item' => __( 'Uploaded to this program', 'full-score-events' ),
				'items_list'            => __( 'Programs list', 'full-score-events' ),
				'items_list_navigation' => __( 'Programs list navigation', 'full-score-events' ),
				'filter_items_list'     => __( 'Filter programs list', 'full-score-events' ),
			],
			'supports'            => [ 'title', 'editor', 'custom-fields' ],
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-playlist-audio',
			'show_in_nav_menus'   => true,
			'has_archive'         => 'programs',
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => [
				'slug'       => 'program',
				'with_front' => true,
				'pages'      => true,
				'feeds'      => true,
			],
			'template'            => [
				[ 'full-score-events/program-edit' ],
			],
		];
	}

	/**
	 * Add program block to main content if there isn't one
	 *
	 * @since 1.0.0
	 *
	 * @param  string $content  Post content.
	 * @return string $content  Post content.
	 */
	protected function get_content( $content ) {

		return ! has_block( 'full-score-events/program' )
			? $content . get_block_template( 'program' )
			: $content;
	}
}
