<ul class="thumbnails">
<?php
foreach($sponsors as $sponsor){
	printf('<li class="span2"><a href="%s" class="thumbnail" title="%s"><img src="%s" alt="%s" class="sponsor_image" /></a></li>',
			$sponsor->sponsor_link,
			$sponsor->sponsor_name,
			$sponsor->image_path,
			$sponsor->sponsor_name,
			$sponsor->sponsor_name
		);
}
?>
<ul>