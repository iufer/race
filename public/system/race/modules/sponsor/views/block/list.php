<?php
foreach($sponsors as $sponsor){
	printf('<div class="span2"><a href="%s" title="%s"><img src="%s" alt="%s" class="sponsor_image" /><br><span class="sponsor_name">%s</span></a></div>',
			$sponsor->sponsor_link,
			$sponsor->sponsor_name,
			$sponsor->image_path,
			$sponsor->sponsor_name,
			$sponsor->sponsor_name
		);
}
