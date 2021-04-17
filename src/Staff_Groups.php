<?php
/**
 * Staff Group + taxonomy functionality handler
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
 * Staff Group registration and general handling
 *
 * @since 1.0.0
 */
class Staff_Groups extends Taxonomy {

	/**
	 * Taxonomy key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const TAX_KEY = 'fse_staff_group';

	/**
	 * Associated post types
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	const POST_TYPES = [ Staff::CPT_KEY ];

	/**
	 * Get general taxonomy label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_label() {
		return __( 'Staff Group', 'full-score-events' );
	}

	/**
	 * Get the plural version of the general taxonomy label
	 *
	 * @since 1.0.0
	 */
	public function get_plural_label() {
		return __( 'Staff Groups', 'full-score-events' );
	}

	/**
	 * Get non-default post type args
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_tax_args() {

		$labels = [
			'name'                       => $this->get_plural_label(),
			'singular_name'              => $this->get_label(),
			'menu_name'                  => __( 'Groups', 'full-score-events' ),
			'all_items'                  => __( 'All Staff Groups', 'full-score-events' ),
			'parent_item'                => __( 'Parent Staff Group', 'full-score-events' ),
			'parent_item_colon'          => __( 'Parent Staff Group:', 'full-score-events' ),
			'new_item_name'              => __( 'New Staff Group Name', 'full-score-events' ),
			'add_new_item'               => __( 'Add New Staff Group', 'full-score-events' ),
			'edit_item'                  => __( 'Edit Staff Group', 'full-score-events' ),
			'update_item'                => __( 'Update Staff Group', 'full-score-events' ),
			'view_item'                  => __( 'View Staff Group', 'full-score-events' ),
			'separate_items_with_commas' => __( 'Separate staff groups with commas', 'full-score-events' ),
			'add_or_remove_items'        => __( 'Add or remove staff groups', 'full-score-events' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'full-score-events' ),
			'popular_items'              => __( 'Popular Staff Groups', 'full-score-events' ),
			'search_items'               => __( 'Search Staff Groups', 'full-score-events' ),
			'not_found'                  => __( 'Not Found', 'full-score-events' ),
			'no_terms'                   => __( 'No staff groups', 'full-score-events' ),
			'items_list'                 => __( 'Staff Groups list', 'full-score-events' ),
			'items_list_navigation'      => __( 'Staff Groups list navigation', 'full-score-events' ),
		];

		return [
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
			'rewrite'           => false,
			'show_in_rest'      => true,
		];
	}

	/**
	 * Output new term form fields
	 *
	 * @since 1.0.0
	 */
	public function do_new_term_fields() {
		?>
		<div class="form-field">
			<label for="fse_associated_page"><?php esc_html_e( 'Associated Page', 'full-score-events' ); ?></label>
			<?php
			wp_dropdown_pages(
				[
					'name'             => 'fse_associated_page',
					'id'               => 'fse_associated_page',
					'show_option_none' => esc_attr_x( 'None', 'staff_group_associated_page', 'full-score-events' ),
				]
			);
			?>
			<p><?php esc_html_e( 'This may be used for linking features, such as a "back to X" link.', 'full-score-events' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Output term edit form fields
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Term $term  Term being edited.
	 */
	public function do_edit_term_fields( $term ) {
		?>
		<tr class="form-field">
			<th scope="row"><label for="fse_associated_page"><?php esc_html_e( 'Associated Page', 'full-score-events' ); ?></label></th>
			<td>
				<?php
				wp_dropdown_pages(
					[
						'name'             => 'fse_associated_page',
						'id'               => 'fse_associated_page',
						'selected'         => esc_attr( get_term_meta( $term->term_id, 'fse_associated_page', true ) ),
						'show_option_none' => esc_attr_x( 'None', 'staff_group_associated_page', 'full-score-events' ),
					]
				);
				?>
				<p><?php esc_html_e( 'This may be used for linking features, such as a "back to X" link.', 'full-score-events' ); ?></p>
			</td>
		</tr>
		<?php
	}

	/**
	 * Run term meta saving/updating
	 *
	 * @since 1.0.0
	 *
	 * @param integer $term_id  Term ID.
	 */
	public function set_term_meta( $term_id ) {

		$associated_page = postval( 'fse_associated_page' );

		// fse_associateD_page field is required where shown, but it isn't part
		// of the quick edit form.
		if ( ! $associated_page ) {
			return;
		}

		update_term_meta( $term_id, 'fse_associated_page', $associated_page );
	}
}
