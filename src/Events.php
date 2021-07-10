<?php
/**
 * Event post type + functionality handler
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

use DateTime;
use WP_Query;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Event CPT registration and general handling
 *
 * @since 1.0.0
 */
class Events extends Post_Type {

	/**
	 * Post type key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const CPT_KEY = 'fse_event';

	/**
	 * Object class to be used for indivudal instances of the post type
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $singular_class = 'Event';

	/**
	 * Flag for global post variable in look
	 *
	 * @since 1.0.0
	 * @var   boolean
	 */
	protected $loop_global_name = 'event';

	/**
	 * Featured events request cache
	 *
	 * @since 1.0.0
	 * @var   WP_Query
	 */
	private static $featured_events;

	/**
	 * Get general post type label
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_label() {
		return __( 'Event', 'full-score-events' );
	}

	/**
	 * Get plural post type label
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_plural_label() {
		return __( 'Events', 'full-score-events' );
	}

	/**
	 * Register location meta
	 *
	 * @since 1.0.0
	 */
	public function do_meta_registration() {

		// Set default date in ISO format.
		$date = new DateTime();
		$date = $date->format( 'c' );

		foreach ( [
			'_is_featured'        => [ 'boolean', false ],
			'_limit_to_ensembles' => [ 'boolean', false ],
			'_date_start'         => [ 'string', $date ],
			'_date_finish'        => [ 'string', $date ],
			'_show_finish'        => [ 'boolean', false ],
			'_is_all_day'         => [ 'boolean', false ],
			'_is_time_tba'        => [ 'boolean', false ],
			'_registration_type'  => [ 'string', '' ],
			'_registration_url'   => [ 'string', '' ],
			'_price'              => [ 'number', 0 ],
			'_show_price'         => [ 'boolean', true ],
			'_location_id'        => [ 'integer', 0 ],
			'_contact_id'         => [ 'integer', 0 ],
		] as $key => $args ) {
			register_post_meta(
				self::CPT_KEY,
				$key,
				[
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => $args[0],
					'default'       => $args[1],
					'auth_callback' => 'Full_Score_Events\get_can_user_edit_posts',
				]
			);
		}
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
			'description'         => __( "Our ensembles' events.", 'full-score-events' ),
			'labels'              => [
				'archives'              => __( 'Event Archives', 'full-score-events' ),
				'attributes'            => __( 'Event Attributes', 'full-score-events' ),
				'parent_item_colon'     => __( 'Parent Event:', 'full-score-events' ),
				'all_items'             => __( 'All Events', 'full-score-events' ),
				'add_new_item'          => __( 'Add New Event', 'full-score-events' ),
				'new_item'              => __( 'New Event', 'full-score-events' ),
				'edit_item'             => __( 'Edit Event', 'full-score-events' ),
				'update_item'           => __( 'Update Event', 'full-score-events' ),
				'view_item'             => __( 'View Event', 'full-score-events' ),
				'view_items'            => __( 'View Events', 'full-score-events' ),
				'search_items'          => __( 'Search Event', 'full-score-events' ),
				'insert_into_item'      => __( 'Insert into event', 'full-score-events' ),
				'uploaded_to_this_item' => __( 'Uploaded to this event', 'full-score-events' ),
				'items_list'            => __( 'Events list', 'full-score-events' ),
				'items_list_navigation' => __( 'Events list navigation', 'full-score-events' ),
				'filter_items_list'     => __( 'Filter events list', 'full-score-events' ),
			],
			'supports'            => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions' ],
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-calendar-alt',
			'show_in_nav_menus'   => true,
			'has_archive'         => 'events',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => false,
			'rewrite'             => [
				'slug'       => 'event',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
			],
			'template'            => [
				[
					'core/paragraph',
					[
						'content'   => __( 'Use this introductory paragraph to describe the event. You can also put a heading above it.', 'full-score-events' ),
						'className' => 'is-style-featured',
					],
				],
				[
					'core/heading',
					[
						'level'   => 3,
						'content' => __( 'Schedule', 'full-score-events' ),
					],
				],
				[ 'full-score-events/schedule' ],
				[
					'core/heading',
					[
						'level'   => 3,
						'content' => __( 'Program', 'full-score-events' ),
					],
				],
				[ 'full-score-events/program' ],
			],
		];
	}

	/**
	 * Get editor title field placeholder
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	protected function get_title_placeholder() {
		return __( 'Add event title', 'full-score-events' );
	}

	/**
	 * Conditionally set main query arguments
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Query $query  Main query for current post type archive.
	 */
	protected function set_query( $query ) {

		$meta_query = $query->get( 'meta_query' ) ?: [];

		// Require and add orderby names for start/finish dates.
		if ( ! $query->is_admin || ( $query->is_admin && $query->get( 'orderby' ) ) ) {
			$meta_query['date_start']  = [
				'key'  => '_date_start',
				'type' => 'DATETIME',
			];
			$meta_query['date_finish'] = [
				'key'  => '_date_finish',
				'type' => 'DATETIME',
			];
		}

		// Order from earliest to latest on front end, excluding passed dates.
		if ( ! $query->is_admin ) {

			$query->set( 'orderby', 'date_start' );
			$query->set( 'order', 'ASC' );

			$now = current_datetime();

			$meta_query['date_finish']['value']   = $now->format( 'c' );
			$meta_query['date_finish']['compare'] = '>';
		}

		// Set our modified meta query.
		$query->set( 'meta_query', $meta_query );
	}

	/**
	 * Manage admin columns
	 *
	 * @since 1.0.0
	 *
	 * @param  array $columns  Column headings.
	 * @return array $columns
	 */
	public function set_posts_columns( $columns ) {

		$ensembles_key = 'taxonomy-' . Ensembles::TAX_KEY;

		// Move date and ensemble columns to end.
		$date      = $columns['date'] ?? false;
		$ensembles = $columns[ $ensembles_key ] ?? false;
		unset( $columns['date'], $columns[ $ensembles_key ] );

		// Add start/finish, location, and contact.
		$columns['featured']         = __( 'Featured', 'full-score-events' );
		$columns['ensemble_limited'] = __( 'Ensemble View Only', 'full-score-events' );
		$columns['date_start']       = __( 'Start', 'full-score-events' );
		$columns['date_finish']      = __( 'Finish', 'full-score-events' );
		$columns['location']         = __( 'Location', 'full-score-events' );
		$columns['contact']          = __( 'Contact', 'full-score-events' );

		if ( $ensembles ) {
			$columns[ $ensembles_key ] = $ensembles;
		}

		if ( $date ) {
			$columns['date'] = __( 'Post Date', 'full-score-events' );
		}

		return $columns;
	}

	/**
	 * Manage sortable admin columns
	 *
	 * @since 1.0.0
	 *
	 * @param  array $columns  Sortable columns.
	 * @return array $columns
	 */
	public function set_sortable_columns( $columns ) {
		$columns['date_start']  = 'date_start';
		$columns['date_finish'] = 'date_finish';
		return $columns;
	}

	/**
	 * Set value of custom admin column
	 *
	 * @since 1.0.0
	 *
	 * @param string $name  Column name.
	 */
	public function do_custom_column( $name ) {

		global $fse_event;

		switch ( $name ) {
			// Featured.
			case 'featured':
				echo $fse_event->is_featured() ? '<span class="dashicons dashicons-star-filled"></span>' : '';
				return;

			// Limited to ensemble's views.
			case 'ensemble_limited':
				echo $fse_event->is_ensemble_limited() ? '<span class="dashicons dashicons-yes"></span>' : '';
				return;

			// Start date.
			case 'date_start':
				echo esc_html( $fse_event->get_date_start()->format( 'M j, Y' ) ) . '<br>';

				if ( $fse_event->is_daily() ) :
					// Translators: Daily (%s).
					printf( esc_html__( 'Daily (%s)', 'full-score-events' ), esc_html( $fse_event->get_time_start() ) );
				elseif ( $fse_event->is_time_tba() ) :
					// phpcs:ignore
					// Translators: %1$sTBA%2$s (%3$s).
					printf( esc_html__( '%1$sTBA%2$s (%3$s)', 'full-score-events' ), '<b>', '</b>', esc_html( $fse_event->get_time_start() ) );
				else :
					$fse_event->do_time_start();
				endif;
				return;

			// Finish date.
			case 'date_finish':
				echo esc_html( $fse_event->get_date_finish()->format( 'M j, Y' ) ) . '<br>';

				if ( $fse_event->is_daily() ) :
					// Translators: Daily (%s).
					printf( esc_html__( 'Daily (%s)', 'full-score-events' ), esc_html( $fse_event->get_time_finish() ) );
				elseif ( $fse_event->is_time_tba() ) :
					// phpcs:ignore
					// Translators: %1$sTBA%2$s (%3$s).
					printf( esc_html__( '%1$sTBA%2$s (%3$s)', 'full-score-events' ), '<b>', '</b>', esc_html( $fse_event->get_time_finish() ) );
				elseif ( $fse_event->get_show_finish() ) :
					$fse_event->do_time_finish();
				else :
					// Translators: %s (not shown).
					printf( esc_html__( '%s (not shown)', 'full-score-events' ), esc_html( $fse_event->get_time_finish() ) );
				endif;
				return;

			// Location.
			case 'location':
				$location = $fse_event->get_location();

				if ( ! $location ) {
					return;
				}

				echo '<a href="' . esc_attr( get_edit_post_link( $location->get_id() ) ) . '">';
				$location->do_title();
				echo '</a><br>';
				$location->do_address( false );
				return;

			// Contact (staff member).
			case 'contact':
				$contact = $fse_event->get_contact();

				if ( ! $contact ) {
					return;
				}

				echo '<a href="' . esc_attr( get_edit_post_link( $contact->get_id() ) ) . '">';
				$contact->do_title();
				echo '</a><br>';
				$contact->do_position();
				return;
		}
	}

	/**
	 * Get upcoming events
	 *
	 * The start_date meta query should be included by default via pre_get_posts
	 * hook.
	 *
	 * @since 1.0.0
	 *
	 * @param  integer $number     Posts to get.
	 * @param  array   $ensembles  Array of ensemble term IDs.
	 * @return WP_Query
	 */
	public static function get_upcoming( $number = 3, $ensembles = [] ) {

		$args = [
			'post_type'      => self::CPT_KEY,
			'posts_per_page' => $number,
		];

		if ( $ensembles ) {
			$args['tax_query'] = [
				[
					'taxonomy' => Ensembles::TAX_KEY,
					'terms'    => $ensembles,
				],
			];
		}

		return new WP_Query( $args );
	}

	/**
	 * Get featured events
	 *
	 * The start_date meta query should be include by default via pre_get_posts
	 * hook.
	 *
	 * @since 1.0.0
	 *
	 * @return WP_Query
	 */
	public static function get_featured() {

		if ( isset( self::$featured_events ) ) {
			return self::$featured_events;
		}

		self::$featured_events = new WP_Query(
			[
				'post_type'      => self::CPT_KEY,
				'posts_per_page' => 20,
				'meta_query'     => [
					'is_featured' => [
						'key'   => '_is_featured',
						'value' => 1,
					],
				],
			]
		);

		return self::$featured_events;
	}
}
