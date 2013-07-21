<ul class="newest-results">	
<?php
	foreach($results as $result){
		printf('<li>%s<br><small>%2$s results posted %3$s</small></li>', 
				anchor("race/{$result->race_url}", $result->race_name, 'class="color-b"'),
				$result->count,
				findTimeGreatest(mysql_to_unix($result->result_date_created))
			);
	}
?>
</ul>