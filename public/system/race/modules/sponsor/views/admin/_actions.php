<div class="btn-group">
	<button class="btn disabled"><i class="icon-cog"></i></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><?= anchor("admin/sponsor/edit/{$sponsor_id}",'Edit') ?></li>
		<li><?= anchor("admin/sponsor/del/{$sponsor_id}", 'Delete', 'class="sponsor_delete"') ?></li>
	</ul>
</div>