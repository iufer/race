<ul class="nav nav-pills">
<?php
	foreach($menu as $item){			
		printf('<li><a href="%1$s" title="%2$s">%2$s</a></li>',
				site_url($item['route']),
				$item['title']
			);	
	}
?>
</ul>