
<ul class="nav nav-pills nav-stacked">
	<li data-rider-category-id='0'><?= anchor("rider", "Show All"); ?></li>
<?php
foreach($rider_categories as $rider_category){
	printf('<li class="rider_category" data-rider-category-id="%3$s"><a href="%1$s">%2$s</a></li>',
				site_url($base_uri . $rider_category->rider_category_id),
				$rider_category->rider_category_name,
				$rider_category->rider_category_id
			);
	}
?>
</ul>