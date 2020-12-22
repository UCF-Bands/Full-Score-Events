<?php
/**
 * Schedule items dynamic block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

$dom = new \DOMDocument();

// Ignore DOMDocument freaking out about <time>... then put it back.
$internal_errors = libxml_use_internal_errors( true );
$loaded          = $dom->loadHTML( $content );
libxml_use_internal_errors( $internal_errors );

$items = $dom->getElementsByTagName( 'li' );
$day   = false;
?>

<div class="fse-schedule">
	<?php
	foreach ( $items as $item ) {

		// Grab the timestamp and output a new date.
		$time = $item->getElementsByTagName( 'time' );

		// Loop is to avoid error.
		foreach ( $time as $time ) {
			$time = new DateTime( $time->getAttribute( 'datetime' ) );
			break;
		}

		$item_day = $time->format( 'l, M j' );

		if ( $day !== $item_day ) {
			echo '<h4 class="fse-schedule-day">' . esc_html( $item_day ) . '</h4>';
			echo '<ul class="fse-schedule-items">';
		}

		echo $dom->saveHTML( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $day !== $item_day ) {
			$day = $item_day;
			echo '</ul>';
		}
	}
	?>
</div>
