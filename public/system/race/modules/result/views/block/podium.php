<?php

$c = setting('rider_podium_places');
if(!$c) $c = 3;

$tbody = array();
$max = 0;

foreach($results as $result){
	$max = ($result > $max) ? $result : $max;
}

for($i=1;$i<=$c;$i++) {
	if(isset($results[$i])){
		$tbody[] = array(
			
			array('td' => sprintf('<div class="progress-podium"><div class="bar" style="width: %2$s%%">%1$s </div></div>', $results[$i], $results[$i] / $max *100)),
			array('th' => formatPlace($i))

		);			
	}
	else {
		$tbody[] = array(
			array('td' => sprintf('<div class="progress-podium"><div class="bar" style="width: %1$s%%"></div></div>', 0 / $max *100)),
			array('th' => formatPlace($i))
		);
	}	
}

echo buildTable($tbody, null, 'table');