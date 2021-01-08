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
	$fse_location->do_address();
	$fse_location->do_map_embed();
	?>

</div>
