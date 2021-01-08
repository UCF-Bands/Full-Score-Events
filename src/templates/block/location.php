<?php
/**
 * Location block template
 *
 * @since   1.0.0
 * @package Full_Score_Events
 */

namespace Full_Score_Events;

global $fse_location;
?>

<div <?php do_attrs_class( 'fse-location', $className ?? '' ); ?>>
	<?php
	$showAddress ? $fse_location->do_address() : null;
	$showMap ? $fse_location->do_map_embed() : null;
	?>
</div>
