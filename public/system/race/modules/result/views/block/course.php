<?php

if($results === false) {
	$thead = null;
	$tbody = array(
		array(
			array('td' => _l('no_results_for_this_course') )
		)
	);
}
else {
	$thead = array(
		array(
			array('th' => _l('rider')),
			array('th' => _l('time')),
			array('th' => _l('speed'))
		)
	);
	$tbody = array('attr' => array('class' => 'table-condensed'));
	foreach($results as $i=>$result) {
		$tbody[] = array(
			array('td' => anchor("rider/{$result->rider_id}", "<strong>{$result->rider_name}</strong> <span class='badge badge-id'>". formatRiderId($result->rider_id) ."</span>") ."<br><small>". anchor("race/{$result->race_url}", date('F j, Y', mysql_to_unix($result->result_date_created))) ."</small>" ),
			array('td' => "<strong>". $result->result_data ."</strong>" ),
			array('td' => "<em>". formatSpeed($result->speed) ."</em>" )
		);
	}
}

echo buildTable($tbody, $thead, 'table table-bordered table-striped');
