<ul class="newest-riders">
<?php
	foreach($riders as $rider){
		printf('<li><a href="%1$s" class="color-b">%2$s <span class="badge badge-id">%3$s</span></a></li>',
				site_url("rider/{$rider->rider_id}"),
				$rider->rider_name,
				formatRiderId($rider->rider_id)				
			);
	}
?>
</ul>