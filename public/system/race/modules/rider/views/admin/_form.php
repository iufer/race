<?= form_open_multipart($form_action, array('class'=>'form-horizontal')); ?>

<fieldset>
	<section class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" class="span6" id="rider_name" value="<?= set_value('name', $name) ?>" />
			<?= form_error('name'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Default Category</label>
		<div class="controls">
			<?php
				echo form_dropdown('rider_category_id', $rider_categories, set_value('rider_category_id', $rider_category_id), 'id="rider_category_id"');
			?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Profile Privacy</label>
		<div class="controls">
			<?php
				echo form_dropdown('public', array('0'=>'Private', '1'=>'Public'), set_value('public', $public), 'id="rider_category_id"');
			?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Info</label>
		<div class="controls">
			<p><strong>Date Added:</strong> <?= $date_created ?><br>
			   <strong>Date Modified:</strong> <?= $date_modified ?><br>
			   <strong>Profile Views:</strong> <?= $profile_views ?>
			</p>
		</div>
	</section>
	<section class="form-actions">
			<button type="submit" class="submit btn btn-primary"><?= $form_submit ?></button>
			<a class="btn" href="<?= site_url("admin/rider")?>">Cancel</a>
	</section>
	

</fieldset>
</form>