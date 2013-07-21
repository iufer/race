<div class="btn-group">
	<button class="btn disabled"><i class="icon-cog"></i></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><?= anchor("admin/message/edit/{$message_id}",'Expire') ?></li>
		<li><?= anchor("admin/message/edit/{$message_id}",'Edit') ?></li>
		<li><?= anchor("admin/message/del/{$message_id}", 'Delete', 'class="message_delete"') ?></li>
	</ul>
</div>