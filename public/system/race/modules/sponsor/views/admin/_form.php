<?= form_open_multipart($form_action, array('class'=>'form-horizontal') ) ?>

<fieldset>
	<section class="control-group">
		<label class="control-label">Name </label>
		<div class="controls">
			<input type="text" name="name" id="sponsor_name" class="span6" value="<?= set_value('name', $name) ?>" />
			<?= form_error('name'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Link</label>
		<div class="controls">
			<input type="text" name="link" id="sponsor_link" class="span6" value="<?= set_value('link', $link) ?>" />
			<?= form_error('link'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Description</label>
		<div class="controls">
			<textarea name="description" id="sponsor_description" class="html span6"><?= set_value('description', $description) ?></textarea>
			<?= form_error('description'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Image</label>
		<div class="controls">
			<?php 
				if($image_path) {
					echo "<img src='$image_path'  class='img-polaroid' style='height:50px;' />";
				}
			?>
			<input type="file" name="image" id="sponsor_image" value="<?= set_value('image') ?>" />
			<?= form_error('image'); ?>
		</div>
	</section>

	<section class="form-actions">
		<button type="submit" class="submit btn btn-primary"><?= $form_submit ?></button>
		<a href="<?= site_url("admin/sponsor") ?>" class="btn">Cancel</a>
		<?php if(isset($form_delete)) : ?>
		<a href="<?= site_url($form_delete) ?>" class="btn btn-danger pull-right">Delete Sponsor</a>
		<?php endif; ?>
	</section>
	
</fieldset>
</form>