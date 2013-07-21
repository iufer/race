<?php

if($upcoming){
	
	$thead = array(
		array(
			array('th' => _l('race_name')),
			array('th' => _l('when')),
			array('th' => _l('type'))
		)
	);

	$tbody = array('attr' => array('class'=>"table-condensed"));

	foreach($upcoming as $race){
		if($race->race_laps > 1){
			$total_distance = $race->race_laps * $race->course_miles;
			$total_elevation = $race->race_laps * $race->course_elevation;
		}
		else {
			$total_distance = (! is_null($race->course_miles)) ? $race->course_miles : 0;
			$total_elevation = (! is_null($race->course_elevation)) ? $race->course_elevation : 0;
		}			

		$tbody[] = array(
			// array('td' => anchor("race/{$race->race_url}", $race->race_name, 'class="color-a"') ."<br>". findTime(mysql_to_unix($race->race_start_time), '<small><em>%d Days, %h Hours, %m Minutes</em></small>')),
			array('td' => anchor("race/{$race->race_url}", $race->race_name, 'class="color-a"') ),
			array('td' => date("l, F j, g:i A", mysql_to_unix($race->race_start_time)), 'attr' => array('width' => '40%')),
			array('td' => $race->race_type_type)
		);		
	}
	
}
else {
	$thead = null;
	$tbody = array( array( array('td' => _l('no_upcoming_races') ) ) );
}

echo buildTable($tbody, $thead, 'table table-bordered table-striped');

