<?php

foreach($rider_categories as $rider_category){

	// if one of the rider categories has results available for display
	if( isset($results[ $rider_category->rider_category_id ]) ){
	
		$riders = $results[ $rider_category->rider_category_id ];		
				
		echo '<section class="rider-category-results">';
		echo "<h3>{$rider_category->rider_category_name} Results</h3>";
		echo buildRiders($riders);
		echo "</section>";
	}
}
