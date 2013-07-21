<?php

if($rider->race_count > $span) {
	printf('<p class="caption">'. _l('showing_results_x_from').' <strong>%s %s</strong></p>', 
		$from+1,
		(($from+1 + $span) < $rider->race_count) ? $from + $span : $rider->race_count, 
		$rider->race_count,
		($rider->race_count > 1) ? _l('races') : _l('race')
	);
}
else {	
	printf('<p class="caption">'. _l('showing_results_from').' <strong>%s %s</strong></p>',
		$rider->race_count,
		($rider->race_count > 1) ? _l('races') : _l('race')
	);
}

echo '<h2 class="heading-underline">All Results</h2>';

// Pagination
echo $pagination_links;

// Iterate over all the Races this rider has results for
foreach($results as $race){

	printf('<hr><div class="row">
				<div class="span3">
					<h4><a rel="popover" data-title="%1$s" data-content="%5$s" href="%4$s">%1$s</a></h4>
					<p class="caption">%3$s</p>
				</div>
				<div class="span5">%2$s</div>
			</div>',
				$race[0]->race_name,
				buildRaceResults($race),
				date('F j, Y', mysql_to_unix($race[0]->race_start_time)),
				site_url("race/". $race[0]->race_url),
				"<strong>{$race[0]->race_subtitle}</strong>"
			);	
}

echo $pagination_links;