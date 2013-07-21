<?php 

if(count($results) == 0) {
	$tbody = array(
		array(
			array('td' => _l('no_results_yet_for_this_series') )
		)
	);
	echo buildTable($tbody, null, 'table table-bordered table-striped');	
}
else {
	$pb = setting('race_point_bracket', true);
	$_riders = array();
	$j = 0;

	// Iterate over all the rider_categories in the database
	// doing it this way because $rider_categories is a nicely ordered array of objects
	// results for a race are ordered as so:

	// rider_categories
	// 	riders
	// 		results
	// 

	foreach($rider_categories as $rider_category){

		// if one of the rider categories has results available for display
		if( isset($results[ $rider_category->rider_category_id ]) ){
			
			$rider_category_riders = $results[ $rider_category->rider_category_id ];				
			foreach($rider_category_riders as $rider_results){
				
				$j++; // rider zebra bit
				$points = array();			
				$races = array();
				$places = array();
				
				$result_count = count($rider_results);
				for($i=0;$i<$result_count;$i++){
					$result = $rider_results[$i];

					// echo $result->rider_name .' '. $result->result_data .' '. $result->result_type_name ."<br>";
					$races[ $result->race_id] = 1;
					
					if($result->result_type_id == 3 and $result->race_point_bracket == 1){
						$places[] = formatPlace($result->result_data);
						
						$bracket = $pb[$result->race_point_bracket_multiplier];
						$b = $bracket->b;
						$r = $bracket->remainder;
						
						if(isset($b[ $result->result_data -1])){				
							$points[] = $b[$result->result_data -1];
						}
						else {
							$points[] = $r;
						}
								
					} else {
						$result_data = $result->result_data;
					}
					
					// add points and primes
					if($result->result_type_id == 1 or $result->result_type_id == 5){
						$points[] = $result->result_data;
					}				
				}

				if(count($points) > 0) {
					$sum = 0;
					if(count($points) > 1){ 
						//$sum_points = implode(' + ', $points);
						foreach($points as $point){ $sum += $point; }
						//$sum_points .= " = $sum";
						$sum_points = $sum;
					}
					else {
						$sum_points = $points[0];
					}
					
					//average the placings
					if(count($places) >0){
						$p = array_sum($places)/count($places);
					}
					else $p = '--';
					$_riders[] = array(
						'id'    => $result->result_rider_id, 
						'name'  => $result->rider_name, 
						'points'=> $sum_points, 
						'races' => count($races), 
						'place' => $p
					);	
				}
			} // 
			
			if(!empty($_riders)){
				// now sort em
				usort($_riders, 'rider_cmp');

				echo "<h2>". $rider_category->rider_category_name ." ". _l('results') ."</h2>";
				$thead = array(
					array(
						array('th' => _l('place')),
						array('th' => _l('rider')),
						array('th' => _l('total_points')),
						array('th' => _l('#_races')),
						array('th' => _l('avg_points')),
						array('th' => _l('avg_place'))
					)
				);
				$tbody = array('attr' => array('class' => 'table-condensed'));

				foreach($_riders as $i=>$rider){
					$tbody[] = array(
						array(
							'td' => $i +1,
							'attr' => array('class' => 'td-active')
						),
						array(
							'td' => anchor("rider/{$rider['id']}", $rider['name'] .' <span class="badge badge-id">#'. str_pad($rider['id'], 3, '0', STR_PAD_LEFT) ."</span>", 'class="result_rider color-b"'),
							'attr' => array('width' => "40%")
						),
						array(
							'td' => "<span class='result_data c2'><strong>{$rider['points']}</strong></span>"
						),
						array('td' => $rider['races']),
						array('td' => number_format($rider['points'] / $rider['races'], 1)),
						array('td' => number_format((int)$rider['place']))
					);
				}

				echo buildTable($tbody, $thead, 'table table-condensed table-bordered result_category_data');
			}
			$_riders = array();
			$races = array();
			$places = array();
		}
	}
	
}