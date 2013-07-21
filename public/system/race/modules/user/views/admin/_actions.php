<div class="btn-group">
	<button class="btn disabled"><i class="icon-cog"></i></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><?= anchor("admin/user/edit/{$user_id}",'Edit') ?></li>
		<li><?= anchor("admin/user/del/{$user_id}", 'Delete', 'class="user_delete"') ?></li>
	</ul>
</div>