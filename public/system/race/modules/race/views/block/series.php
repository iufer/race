<?php

$thead = array(
	array(
		array('th' => _l('name')),
		array('th' => _l('date')),
		array('th' => _l('time')),
		array('th' => _l('distance')),
		array('th' => _l('elevation'))
	)
);

$tbody = array('attr' => array('class'=>"table-condensed"));
if(count($races) > 0){
	foreach($races as $race){
		if($race->race_laps > 1){
			$total_distance = $race->race_laps * $race->course_miles;
			$total_elevation = $race->race_laps * $race->course_elevation;
		}
		else {
			$total_distance = (! is_null($race->course_miles)) ? $race->course_miles : 0;
			$total_elevation = (! is_null($race->course_elevation)) ? $race->course_elevation : 0;
		}			
		
		$tbody[] = array(
			array('td' => anchor("race/{$race->race_url}", $race->race_name, 'class="color-a"')),
			array('td' => date("l, F j", mysql_to_unix($race->race_start_time))),
			array('td' => date("g:i A", mysql_to_unix($race->race_start_time))),
			array('td' => formatMiles($total_distance)),
			array('td' => formatElevation($total_elevation))
		);
	}

	// Echo script
	?>
		<script type="text/javascript" charset="utf-8">
			require(['jquery'], function($){
				var rows = $('#race_index_table tbody tr').length;
				$('#race_index_table tbody :nth-child(n+6)').hide();
				$('<tr><td colspan="5" class="show-all">&darr; Show All '+ rows +' Races</td></tr>')
					.appendTo('#race_index_table tbody')
					.toggle(function(){
						$(this).find('td').html('&uarr; Show Fewer Races');
						$('#race_index_table tbody tr').show();
					},
					function(){
						$('#race_index_table tbody :nth-child(n+6)').hide();
						$(this).show()
							.find('td').html('&darr; Show All '+ rows +' Races');				
					});
			});
		</script>
	<?php
}
else {
	$thead = null;
	$tbody = array(
		array(
			array('td'=>'No series races yet.')
		)
	);
}

echo buildTable($tbody, $thead, "table table-bordered table-striped", "race_index_table");
