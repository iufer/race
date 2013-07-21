<?php

// $thead = array(
// 	array(
// 		array('th' => _l('name')),
// 		array('th' => _l('date'))
// 	)
// );

if($races === false) {
	$tbody = array(
		array(
			array('td'=> _l('no_races_are_set_for_this_course'))
		)
	);
}
else {
	$tbody = array('attr' => array('class'=>'table-condensed'));
	foreach($races as $i => $race){
		$tbody[] = array(
			array(
				'td' => anchor("race/{$race->race_url}", $race->race_name),
				'attr' => array('class'=>'race_name', 'width'=>"50%")
			),
			array(
				'td' => date("l, F j, Y", mysql_to_unix($race->race_start_time)),
				'attr' => array('class'=>'race_date')
			)
		);
	}
}

echo buildTable($tbody, null, "table table-bordered table-striped", "race_index_table");
