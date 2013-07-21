<ul class="series_list">
<?php
foreach($series as $s){
	printf('<li class="series_name">%s</li>', anchor("series/{$s->series_url}", $s->series_name));
}
?>
</ul>