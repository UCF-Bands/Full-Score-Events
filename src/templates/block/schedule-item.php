<?php
/**
 * Schedule item dynamic block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

$time = new DateTime( $dateTime );
$time = gmdate( 'g:i a', $time->getTimestamp() );
?>

<li class="fse-schedule-item">
	<time datetime="<?php echo esc_attr( $dateTime ); ?>"><?php echo esc_html( $time ); ?></time>
	<div class="fse-schedule-activity"><?php echo trim( $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
</li>
