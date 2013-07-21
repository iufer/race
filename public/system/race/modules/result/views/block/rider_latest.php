<?php 

// pr($race); 

$pb = setting('race_point_bracket', true);

$place = false;
$speed = false;
$time = false;
$sum = false;
$points = array();

$result_count = count($race);	

foreach($race as $result){
	
	// if the result type is Place, then we calculate points
	if($result->result_type_id == 3){		
		$place = formatPlace($result->result_data);		
		
		// this race uses points brackets
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
	
	// time and speed
	if($result->result_type_id == 2){
		$time = $result->result_data;
		$speed = number_format($result->speed, 1);
	}
	
	// if its a point or prime then add it to the heap
	if($result->result_type_id == 1 or $result->result_type_id == 5){
		$points[] = $result->result_data;
	}
}

// Here we are calculating the Totals for all the points
if(count($points) > 0) {
	$sum = 0;
	if(count($points) > 1){ 
		foreach($points as $point){ $sum += $point; }
	}
	else {
		$sum = $points[0];
	}
}

?>
<div class="latest-result">
	<p class="caption"><?php if($rider_name) echo $rider_name ."'s "; ?>Latest Result</p>
	<h2 class="heading-underline"><?php echo anchor("race/{$result->race_url}", $result->race_name); ?></h2>

	<div class="row">
		<?php if($place) : ?>
		<div class="span2 result-one">
			<h4>PLACE</h4>
			<h1><?= $place ?></h1>
		</div>
		<? endif; ?>

		<?php if($time) : ?>
		<div class="span2 result-two">
			<h4>TIME</h4>
			<h1><?= $time ?></h1>
		</div>
		<? endif; ?>

		<?php if($speed) : ?>
		<div class="span2 result-three">
			<h4>MPH</h4>
			<h1><?= $speed ?></h1>
		</div>
		<? endif; ?>

		<?php if($sum) : ?>
		<div class="span2 result-four">
			<h4>TOTAL POINTS</h4>
			<h1><?= $sum ?></h1>
		</div>
		<? endif; ?>
	</div>
</div>