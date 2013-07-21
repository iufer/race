<div class="btn-group">
	<button class="btn disabled"><i class="icon-cog"></i></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><?= anchor_popup("series/{$series_url}", "View", array('width'=>1024, 'height'=>700)) ?></li>
		<li><?= anchor("admin/series/edit/{$series_id}",'Edit') ?></li>
		<li><?= anchor("admin/series/del/{$series_id}", 'Delete', 'class="series_delete"') ?></li>
	</ul>
</div>