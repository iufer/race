<ul class="nav">
<?php
	foreach($menu as $item){	
		// check the url
		$active = ($this->uri->segment(1) == $item['route']);
		
		printf('<li class="site_menu_item %2$s"><a href="%1$s" title="%3$s"><span class="menu_name">%3$s</span></a></li>',
				site_url($item['route']),
				($active) ? "active" : null,
				$item['title']
			);	
	}
?>
</ul>