<?= form_open_multipart($form_action, array('class'=>'form-horizontal')); ?>
	
<fieldset>
	<section class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" class="span6" name="name" id="course_name" value="<?= set_value('name', $name) ?>" required="required" />
			<?= form_error('name'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="url">URL Name</label>
		<div class="controls">
			<input type="text" class="span4" name="url" id="course_url" value="<?= set_value('url', $url) ?>" />
			<?= form_error('url'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="description">Description</label>
		<div class="controls">
			<textarea name="description" id="course_description" class="html span6"><?= set_value('description', $description) ?></textarea>
			<?= form_error('description'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="kml">Course KML</label>
		<div class="controls">			
			<?php if($kml != '') : ?>
				<div class="well"><strong>Loaded KML: </strong><?= $kml ?></div>
			<?php endif; ?>
			
			<input type="file" name="kml" id="course_kml" value="<?= set_value('kml') ?>" />
			<?= form_error('kml'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="miles">Miles</label>
		<div class="controls">
			<input type="text" name="miles" id="course_miles" class="decimal span1" value="<?= set_value('miles', $miles) ?>" />
			<?= form_error('miles'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="elevation">Elevation Gain (ft)</label>
		<div class="controls">
			<input type="number" name="elevation" id="course_elevation" class="integer span1" data-min="0" value="<?= set_value('elevation', $elevation) ?>" />
			<?= form_error('elevation'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="category_climb">Category Climb</label>
		<div class="controls">
			<input type="number" name="category_climb" class="span1 integer" id="course_category_climb" data-min="0" value="<?= set_value('category_climb', $category_climb) ?>" />
			<?= form_error('category_climb'); ?>
		</div>
	</section>
	
	<section class="form-actions">
			<button type="submit" class="submit btn btn-primary"><?= $form_submit ?></button>
			<a href="<?= site_url("admin/course") ?>" class="btn">Cancel</a>
			<?php if(isset($form_delete)): ?>
			<a href="<?= site_url($form_delete) ?>" class="btn btn-danger pull-right">Delete</a>
			<?php endif; ?>
	</section>
</fieldset>
</form>