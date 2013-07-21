<?php

$default = 2;
foreach($race_statuses as $race_status){
	$data = array(
	    'name'    => 'race_status_id',
		'id'      => 'race_status_id_'. $race_status->race_status_id,
	    'value'   => $race_status->race_status_id,
	    'checked' => ($race_status->race_status_id == $race_status_id || $race_status->race_status_id == $default),
		'class'   => 'race_status radio'
	);
	
	printf('<label class="%s">%s %s</label>',
		"radio inline",
		form_radio($data),
		$race_status->race_status_name
	);
}
