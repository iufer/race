<div class="btn-group">
	<button class="btn disabled"><i class="icon-cog"></i></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><?= anchor_popup("course/{$course_url}", "View", array('width'=>1024, 'height'=>700)) ?></li>
		<li><?= anchor("admin/race/edit/{$course_id}",'Edit') ?></li>
		<li><?= anchor("admin/course/del/{$course_id}", 'Delete', 'class="course_delete"') ?></li>
	</ul>
</div>