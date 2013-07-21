<?= form_open($form_action, array('class'=>'form-horizontal')); ?>

<fieldset>
	<section class="control-group">
		<label class="control-label">Name</label>
		<div class="controls">
			<input type="text" name="name" class="span4" value="<?= set_value('name', $name) ?>" id="user_name" />
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label">Email</label>
		<div class="controls">
			<input type="text" name="email" class="span4" value="<?= set_value('email', $email) ?>" id="user_email" />
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label">Password</label>
		<div class="controls">
			<input type="text" name="password" class="span2" value="<?= set_value('password', $password) ?>" id="user_password" />
		</div>
	</section>
	
	<section class="form-actions">
			<button type="submit" class="submit btn btn-primary"><?= $form_submit ?></button>
			<a href="<?= site_url("admin/user") ?>" class="btn">Cancel</a>
			<?php if(isset($form_delete)) : ?>
			<a href="<?= site_url($form_delete) ?>" class="btn btn-danger pull-right">Delete User</a>
			<?php endif; ?>
	</section>
	
</fieldset>
</form>