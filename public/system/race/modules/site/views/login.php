<?php $this->load->header('Director Login', 'admin_login'); ?>

<div class="row">
	<div class="span6 offset3" style="margin-top:5em; margin-bottom:20em;">
	
		<h1>Director Login</h1>

		<form action="<?= site_url('site/login') ?>" method="POST" accept-charset="utf-8" class="form-vertical well">
			
			<label>Email</label>
			<input type="text" name="email" value="<?= set_value('email') ?>" id="user_email" placeholder="email">
			<?= form_error('email') ?>

			<label>Password</label>
			<input type="password" name="password" value="<?= set_value('password') ?>" id="user_password">	
			<?= form_error('password') ?>
			
			
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><i class="icon-share-alt icon-white"></i> Login</button>
			</div>
		</form>
	</div>
</div>

<?php $this->load->footer(); ?>