<?php
/**
 * Staff post type + functionality handler
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
 * Staff registration and general handling
 *
 * @since 1.0.0
 */
class Staff extends Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const CPT_KEY = 'fse_staff';

	/**
	 * Object class to be used for indivudal instances of the post type
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $singular_class = 'Staff_Member';

	/**
	 * Flag for global post variable in look
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $loop_global_name = 'staff_member';

	/**
	 * Get general post type label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_label() {
		return __( 'Staff Member', 'full-score-events' );
	}

	/**
	 * Get plural post type label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_plural_label() {
		return __( 'Staff', 'full-score-events' );
	}

	/**
	 * Register staff meta
	 *
	 * @since 1.0.0
	 */
	public function do_meta_registration() {

		foreach ( [
			'_position',
			'_phone',
			'_phone_display',
			'_email',
		] as $key ) {
			register_post_meta(
				self::CPT_KEY,
				$key,
				[
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => 'string',
					'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
				]
			);
		}
	}

	/**
	 * Get non-default post type args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_cpt_args() {
		return [
			'description'         => __( 'Organization staff members.', 'full-score-events' ),
			'labels'              => [
				'archives'              => __( 'Staff Archives', 'full-score-events' ),
				'attributes'            => __( 'Staff Attributes', 'full-score-events' ),
				'all_items'             => __( 'All Staff', 'full-score-events' ),
				'add_new_item'          => __( 'Add New Staff Member', 'full-score-events' ),
				'new_item'              => __( 'New Staff Member', 'full-score-events' ),
				'edit_item'             => __( 'Edit Staff Member', 'full-score-events' ),
				'update_item'           => __( 'Update Staff Member', 'full-score-events' ),
				'view_item'             => __( 'View Staff Member', 'full-score-events' ),
				'view_items'            => __( 'View Staff', 'full-score-events' ),
				'search_items'          => __( 'Search staff', 'full-score-events' ),
				'featured_image'        => __( 'Photo', 'full-score-events' ),
				'set_featured_image'    => __( 'Set photo', 'full-score-events' ),
				'remove_featured_image' => __( 'Remove photo', 'full-score-events' ),
				'use_featured_image'    => __( 'Use as photo', 'full-score-events' ),
				'insert_into_item'      => __( 'Insert into staff member', 'full-score-events' ),
				'uploaded_to_this_item' => __( 'Uploaded to this staff member', 'full-score-events' ),
				'items_list'            => __( 'Staff list', 'full-score-events' ),
				'items_list_navigation' => __( 'Staff list navigation', 'full-score-events' ),
				'filter_items_list'     => __( 'Filter staff list', 'full-score-events' ),
			],
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-businessman',
			'show_in_nav_menus'   => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => [
				'slug'       => 'staff',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
			],
			'template'            => [
				[ 'full-score-events/staff-details' ],
			],
		];
	}

	/**
	 * Get editor title field placeholder
	 *
	 * @return string
	 * @since  1.0.0
	 */
	protected function get_title_placeholder() {
		return __( "Staff member's name", 'full-score-events' );
	}

	/**
	 * Manage admin columns
	 *
	 * @param  array $columns Column headings.
	 * @return array $columns
	 *
	 * @since 1.0.0
	 */
	public function set_posts_columns( $columns ) {

		$groups_index = 'taxonomy-' . Staff_Groups::TAX_KEY;

		// Move title, date, and tax columns.
		$title  = $columns['title'] ?? false;
		$date   = $columns['date'] ?? false;
		$groups = $columns[ $groups_index ] ?? false;
		unset( $columns['title'], $columns['date'], $columns[ $groups_index ] );

		$columns['thumbnail'] = __( 'Photo', 'full-score-events' );

		if ( $title ) {
			$columns['title'] = $title;
		}

		$columns['title']    = __( 'Name', 'full-score-events' );
		$columns['position'] = __( 'Title', 'full-score-events' );
		$columns['email']    = __( 'Email', 'full-score-events' );
		$columns['phone']    = __( 'Phone', 'full-score-events' );

		if ( $groups ) {
			$columns[ $groups_index ] = $groups;
		}

		if ( $date ) {
			$columns['date'] = $date;
		}

		return $columns;
	}

	/**
	 * Set value of custom admin column
	 *
	 * @param string $name  Column name.
	 * @since 1.0.0
	 */
	public function do_custom_column( $name ) {

		global $fse_staff_member;

		switch ( $name ) {
			case 'thumbnail':
				the_post_thumbnail( [ 100, 100 ] );
				return;

			case 'position':
				$fse_staff_member->do_position();
				return;

			case 'email':
				$fse_staff_member->do_email();
				return;

			case 'phone':
				$fse_staff_member->do_phone_display();
				return;
		}
	}
}
