<ul class="nav nav-pills nav-stacked">
	<li><a data-race-type-id='0' href="<?= site_url("race"); ?>">Show All</a></li>
<?php
foreach($race_types as $race_type){
	printf('<li class="%4$s" data-race-type-id="%3$s"><a href="%1$s">%2$s</a></li>',
				site_url($base_uri . $race_type->race_type_id),
				$race_type->race_type_description,
				$race_type->race_type_id,
				($race_type->race_type_id == $selected_race_type_id) ? 'active' : ''
			);
}
?>
</ul>