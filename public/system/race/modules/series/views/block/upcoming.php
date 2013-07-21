<?php 
	if($series === false) {
		$thead = null;
		$tbody = array(
			array(
				array('td'=> _l('no_upcoming_series') )
			)
		);
	}
	else {
		// $thead = array(
		// 			array(
		// 				array('th'=> _l('name') ),
		// 				array('th'=> _l('when') )
		// 			)
		// 		);
		$thead = null;
		$tbody = array();
		foreach($series as $s){
			$tbody[] = array(
				array('td' => anchor("series/{$s->series_url}", $s->series_name, 'class="color-a"') ),
				array('td' => date("F j", mysql_to_unix($s->series_date_start)) ." &ndash; ". date("F j, Y", mysql_to_unix($s->series_date_end)) )
			);
		}
	}

	echo buildTable($tbody, $thead, 'table table-bordered table-striped');