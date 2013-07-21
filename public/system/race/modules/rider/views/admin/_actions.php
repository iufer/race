<div class="btn-group">
	<button class="btn disabled"><i class="icon-cog"></i></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><?= anchor_popup("rider/{$rider_id}", "View", array('width'=>1024, 'height'=>700)) ?></li>
		<li><?= anchor("admin/rider/edit/{$rider_id}",'Edit') ?></li>
		<li><?= anchor("admin/rider/del/{$rider_id}", 'Delete', 'class="rider_delete"') ?></li>
	</ul>
</div>