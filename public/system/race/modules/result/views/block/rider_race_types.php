<?php

$tbody = array();
$total = 0;
foreach($race_types as $race_type){
	$total += $race_type->race_count;
}

foreach($race_types as $race_type){

	$tbody[] = array(
		array('td' => sprintf('<div class="progress-types"><div class="bar" style="width: %2$s%%">%1$s </div></div>', $race_type->race_count, $race_type->race_count / $total *100)),
		array('th' => $race_type->race_type_description)
	);
	
}

echo buildTable($tbody, null, "table");