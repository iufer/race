<?php

/**
 * Takes an array of riders_results and outputs a 12 grid wide result		
 *
 * @param array $riders an array containing arrays of result objects
 * @return string
 * @author cgiufer
 */
function buildRiders($riders, $admin = false){
	$j = 0;
	$out = array();
	foreach($riders as $i=>$rider_results){		
		$j++; // rider zebra bit
	
		$result_count = count($rider_results);
		
		if($admin){

			$out[] = sprintf('<div class="row rider-result">
					<div class="span3">
						<h4><a href="%3$s">%1$s <span class="badge badge-id">%4$s</span></a></h4>
					</div>
					<div class="span6">%2$s</div>
					</div><hr>',
					$rider_results[0]->rider_name,
					buildRiderResults($rider_results, true),
					site_url("rider/". $rider_results[0]->result_rider_id),
					formatRiderId($rider_results[0]->result_rider_id)
				);
		}
		else {
			$out[] = sprintf('<div class="row rider-result">
					<div class="span3">
						<h4><a href="%3$s">%1$s <span class="badge badge-id">%4$s</span></a></h4>
					</div>
					<div class="span9">%2$s</div>
				</div><hr>',
					$rider_results[0]->rider_name,
					buildRiderResults($rider_results),
					site_url("rider/". $rider_results[0]->result_rider_id),
					formatRiderId($rider_results[0]->result_rider_id)
				);
		}
	}
	return implode("\n", $out);
}


/**
 * Calculates the result data rows for an array of rider results
 *
 * @param array $rider_results an array of results objects
 * @return string
 * @author cgiufer
 */
function buildRiderResults($rider_results, $admin = false){
	$pb = setting('race_point_bracket', true);
	 // format is [{name, b, remainder}]

	$out = array();
	$points = array();		
	$rows = array();
		
	foreach($rider_results as $i=>$result){
		$result_data = $result->result_data;

		// if this is type: Place and race has point bracket, calculate score
		if($result->result_type_id == 3){
			$result_data = formatPlace($result->result_data);
			if($result->race_point_bracket == 1){
				
				$bracket = $pb[$result->race_point_bracket_multiplier];
				$b = $bracket->b;
				$r = $bracket->remainder;
				
				if(isset($b[ $result->result_data -1])){
					$points[] = $b[$result->result_data -1];
				}
				else { // apply remainder
					$points[] = $r;
				}
			}
		}

		// if($result->result_type_id == 2) {
		// 	$result_data = formatTime($result->result_data_raw); 
		// }
	
		// if its a point or prime then add it to the heap
		if($result->result_type_id == 1 or $result->result_type_id == 5){
			$points[] = $result->result_data;
		}
		
		$row = array(
			array(
				'td' => "<strong>{$result_data}</strong>",
				'attr' => array('width' => "20%",'class' => "text-right nowrap td-active")
			),
			array(
				'td' => $result->result_type_name,
				'attr' => array('width' => "20%",'class' => "nowrap")
			),
			array(
				'td' => ($result->result_type_id == 2 and $result->speed) ? formatSpeed($result->speed) : '&nbsp;',
				'attr' => array('width' => "15%", 'class' => "result_speed")
			),
			array(
				'td' => ($result->result_note) ? $result->result_note : "&nbsp;"
			)
		);

		// Add the admin editing buttons
		if($admin) {
			$delete_link = anchor("admin/result/del/{$result->result_id}", '<span class="float-right ui-icon ui-icon-trash">&nbsp;</span>', 'class="result_delete btn"');
			$edit_link = anchor("admin/result/edit/{$result->result_id}", '<span class="float-right ui-icon ui-icon-gear">&nbsp;</span>', 'class="result_edit btn"');

			$row[] = array(
				'td' => $edit_link ." ". $delete_link,
				'attr' => array('style'=> "text-align:right;")
			);
		}

		$rows[] = $row;
	}

	if(count($points) > 0) {
		$sum = 0;
		if(count($points) > 1){ 
			$sum_points = implode(' + ', $points);
			foreach($points as $point){ $sum += $point; }

			$sum_points = "<em>$sum_points</em> = <strong>$sum</strong>";
		}
		else {
			$sum_points = $points[0];
		}
	
		$rows[] = array(
			array(
				'td' => "&nbsp;",
				'attr' => array('width' => "15%")
			),
			array(
				'td' => $sum_points . " <strong>Total Points</strong>",
				'attr' => array('width' => "25%",'class' => "nowrap", 'colspan' => "3")
			)
		);

		if($admin) {
			// add the extra td
			$rows[ count($rows) -1 ][] = array('td' => "&nbsp;");
		}
	}
	
	return buildTable($rows, null, "table table-condensed");
}


function buildRaceResults($race){
	$out = array();
	$points = array();
	$pb = setting('race_point_bracket', true);	
	$rows = array();
	
	// $out[] = '<table class="table table-condensed"><tbody>';
	foreach($race as $i=>$result) {
		$result_data = $result->result_data;
		
		// if the result type is Place, then we calculate points
		if($result->result_type_id == 3){			
			$result_data = formatPlace($result->result_data);
			
			if($result->race_point_bracket == 1){
				// get the bracket score
				
				$bracket = $pb[$result->race_point_bracket_multiplier];
				$b = $bracket->b;
				$r = $bracket->remainder;
								
				if(isset($b[ $result->result_data -1])){				
					$points[] = $b[$result->result_data -1];
				}
				else {
					$points[] = $r;
				}
			}
		} 
		
		// add points and primes
		if($result->result_type_id == 1 or $result->result_type_id == 5){
			$points[] = $result->result_data;
		}
		
		$rows[] = array(
			array(
				'td' => "<strong>". $result_data ."</strong>",
				'attr' => array('width' => "15%", 'class' => 'text-right nowrap td-active')
			),
			array(
				'td' => $result->result_type_name,
				'attr' => array('width' => "20%")
			),
			array(
				'td' => ($result->result_type_id == 2 and $result->speed) ? formatSpeed($result->speed) : '&nbsp;',
				'attr' => array('width' => "15%", 'class' => "result_speed")
			),
			array(
				'td' => ($result->result_note) ? "<i title='{$result->result_note}' rel='tooltip' class='icon-comment tip'></i>" : "&nbsp;",
				'attr' => array('width' => "5%")
			)
		);
		
	}

	// Here we are calculating the Totals for all the points
	if(count($points) > 0) {
		$sum = 0;
		if(count($points) > 1){ 
			$sum_points = implode(' + ', $points);
			foreach($points as $point){ $sum += $point; }
			$sum_points = "<em>$sum_points</em> = <strong>$sum</strong>";
		}
		else {
			$sum_points = $points[0];
		}

		$rows[] = array(
			array(
				'td' => "&nbsp;",
				'attr' => array('class' => 'nowrap')
			),
			array(
				'td' => $sum_points . " <strong>Total Points</strong>",
				'attr' => array('class' => 'nowrap', 'colspan' => "3")
			)
		);
	}
	
	return buildTable($rows, null, "table table-condensed");
}