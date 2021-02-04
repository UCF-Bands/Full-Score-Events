<?php
/**
 * "Seasons" taxonomy handler for grouping time periods (such as semesters)
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

use DateTime;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * "Season" registration and general handling
 *
 * @since 1.0.0
 */
class Seasons extends Taxonomy {

	/**
	 * Taxonomy key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const TAX_KEY = 'fse_season';

	/**
	 * Associated post types
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	const POST_TYPES = [ Events::CPT_KEY ];

	/**
	 * Get general taxonomy label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_label() {
		return __( 'Season', 'full-score-events' );
	}

	/**
	 * Get the plural version of the general taxonomy label
	 *
	 * @since 1.0.0
	 */
	public function get_plural_label() {
		return __( 'Seasons', 'full-score-events' );
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
			'all_items'                  => __( 'All Seasons', 'full-score-events' ),
			'parent_item'                => __( 'Parent Season', 'full-score-events' ),
			'parent_item_colon'          => __( 'Parent Season:', 'full-score-events' ),
			'new_item_name'              => __( 'New Season Name', 'full-score-events' ),
			'add_new_item'               => __( 'Add New Season', 'full-score-events' ),
			'edit_item'                  => __( 'Edit Season', 'full-score-events' ),
			'update_item'                => __( 'Update Season', 'full-score-events' ),
			'view_item'                  => __( 'View Season', 'full-score-events' ),
			'separate_items_with_commas' => __( 'Separate seasons with commas', 'full-score-events' ),
			'add_or_remove_items'        => __( 'Add or remove seasons', 'full-score-events' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'full-score-events' ),
			'popular_items'              => __( 'Popular Seasons', 'full-score-events' ),
			'search_items'               => __( 'Search Seasons', 'full-score-events' ),
			'not_found'                  => __( 'Not Found', 'full-score-events' ),
			'no_terms'                   => __( 'No seasons', 'full-score-events' ),
			'items_list'                 => __( 'Seasons list', 'full-score-events' ),
			'items_list_navigation'      => __( 'Seasons list navigation', 'full-score-events' ),
		];

		return [
			'labels'             => $labels,
			'hierarchical'       => false,
			'public'             => true,
			'show_ui'            => true,
			'show_admin_column'  => false,
			'show_in_nav_menus'  => false,
			'show_tagcloud'      => false,
			'rewrite'            => false,
			'show_in_quick_edit' => false,
			'show_in_rest'       => false,
		];
	}

	/**
	 * Enqueue datepicker scripts
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		// Sanity check term edit screen.
		if ( ! $this->is_term_edit() ) {
			return;
		}

		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style(
			'jquery-ui-base-theme',
			'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
			[],
			'1.12.1'
		);
	}

	/**
	 * Output new term form fields
	 *
	 * @since 1.0.0
	 */
	public function do_new_term_fields() {
		?>
		<div class="form-field form-required">
			<label for="fse_date_start"><?php esc_html_e( 'Start Date', 'full-score-events' ); ?></label>
			<input name="fse_date_start" id="fse_date_start" type="text"  class="fse-date-picker">
		</div>
		<?php
		$this->do_date_picker_script();
	}

	/**
	 * Output term edit form fields
	 *
	 * @param WP_Term $term  Term being edited.
	 * @since 1.0.0
	 */
	public function do_edit_term_fields( $term ) {
		$date_start = DateTime::createFromFormat( 'Ymd', get_term_meta( $term->term_id, 'fse_date_start', true ) );
		$date_start = $date_start->format( 'm/d/Y' );
		?>
		<tr class="form-field form-required">
			<th scope="row"><label for="fse_date_start"><?php esc_html_e( 'Start Date', 'full-score-events' ); ?></label></th>
			<td><input name="fse_date_start" id="fse_date_start" type="text" value="<?php echo esc_html( $date_start ); ?>" class="fse-date-picker"></td>
		</tr>
		<?php
		$this->do_date_picker_script();
	}

	/**
	 * Output jQuery UI datepicker init script
	 *
	 * @since 1.0.0
	 */
	private function do_date_picker_script() {
		?>
		<script>
			jQuery( document ).ready( function( $ ) {
				$( '.fse-date-picker' ).datepicker( {
					dateFormat: 'mm/dd/yy',
				} );
			} );
		</script>
		<?php
	}

	/**
	 * Run term meta saving/updating
	 *
	 * @param integer $term_id  Term ID.
	 * @since 1.0.0
	 */
	public function set_term_meta( $term_id ) {
		$date_start = DateTime::createFromFormat( 'm/d/Y', postval( 'fse_date_start' ) );

		update_term_meta(
			$term_id,
			'fse_date_start',
			$date_start->format( 'Ymd' )
		);
	}
}
