<div class="btn-group">
	<button class="btn disabled"><i class="icon-cog"></i></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><?= anchor_popup("race/{$race_url}", "View", array('width'=>1024, 'height'=>700)) ?></li>
		<li><?= anchor("admin/race/edit/{$race_id}#results",'Add&nbsp;Result') ?></li>
		<li><?= anchor("admin/race/edit/{$race_id}",'Edit') ?></li>
		<li><?= anchor("admin/race/duplicate/{$race_id}",'Clone') ?></li>
		<li><?= anchor("admin/race/del/{$race_id}", 'Delete', 'class="race_delete"') ?></li>
	</ul>
</div>