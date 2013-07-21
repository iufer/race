<?php 
$this->load->header('Site Settings', 'site_settings');
requirejs('views/admin.form');

$flash = $this->session->flashdata('updated');
if($flash) {
	echo "<div class='alert info'>$flash</div>";
}

echo validation_errors();
?>

<?php echo form_open('admin/site/settings', array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Site Settings</legend>
		
		<section class="control-group">
			<label class="control-label" for="site_domain">Site Domain</label> 
			<div class="controls">
				<input value="<?= setting('site_domain') ?>" type="text" name="site_domain" id="site_domain" class="text span6" />
				<span class="help-block">Don&rsquo;t include http:// or any slashes in the name</span>				
			</div>
		</section>
		
		<section class="control-group">
			<label class="control-label" for="site_name">Site Name</label> 
			<div class="controls">
				<input value="<?= set_value('site_name') ?>" type="text" name="site_name" id="site_name" class="text span6" />
			</div>
		</section>
		
		<section class="control-group">
			<label class="control-label" for="site_description">Site Description</label>
			<div class="controls">
				<input value="<?= set_value('site_description') ?>" type="text" name="site_description" id="site_description" class="text span6" />
			</div>
		</section>
		
		<section class="control-group">
			<label class="control-label" for="site_city">City</label>
			<div class="controls">
				<input value="<?= set_value('site_city') ?>" type="text" name="site_city" id="site_city" class="text span6" />
			</div>
		</section>		
		
		<section class="control-group">
			<label class="control-label" for="site_state">State</label>
			<div class="controls">
				<input value="<?= setting('site_state') ?>" type="text" name="site_state" id="site_state" class="text span6" />
			</div>
		</section>		

		<section class="control-group">
			<label class="control-label" for="site_about">About</label>
			<div class="controls">
				<textarea name="site_about" class="html span6" id="site_about"><?= setting('site_about') ?></textarea>
			</div>
		</section>		

		<section class="control-group">
			<label class="control-label" for="site_copyright">Copyright</label>
			<div class="controls">
				<input value="<?= setting('site_copyright') ?>" type="text" name="site_copyright" id="site_copyright" class="text span6" />
			</div>
		</section>
		
		<section class="control-group">
			<label class="control-label" for="site_google_analytics_account">Google Analytics Property ID</label>
			<div class="controls">
				<input value="<?= setting('site_google_analytics_account') ?>" type="text" name="site_google_analytics_account" id="site_google_analytics_account" class="text span6" />
			</div>
		</section>		
				
	</fieldset>
	
	<fieldset>
		<legend>Content Blocks</legend>
		<section class="control-group">
			<label class="control-label" for="cms_race_sidebar">Race Sidebar</label>
			<div class="controls">
				<textarea name="cms_race_sidebar" class="html span6" id="cms_race_sidebar"><?= setting('cms_race_sidebar') ?></textarea>
			</div>
		</section>
		<section class="control-group">
			<label class="control-label" for="cms_course_sidebar">Courses Sidebar</label>
			<div class="controls">
				<textarea name="cms_course_sidebar" class="html span6" id="cms_course_sidebar"><?= setting('cms_course_sidebar') ?></textarea>
			</div>
		</section>
		<section class="control-group">
			<label class="control-label" for="cms_series_sidebar">Series Sidebar</label>
			<div class="controls">
				<textarea name="cms_series_sidebar" class="html span6" id="cms_series_sidebar"><?= setting('cms_series_sidebar') ?></textarea>
			</div>
		</section>
		<section class="control-group">
			<label class="control-label" for="cms_rider_sidebar">Riders Sidebar</label>
			<div class="controls">
				<textarea name="cms_rider_sidebar" class="html span6" id="cms_rider_sidebar"><?= setting('cms_rider_sidebar') ?></textarea>
			</div>
		</section>
		
	</fieldset>
	
	<fieldset>
		<legend>Sharing</legend>
		<section class="control-group">
			<label class="control-label" for="site_share_flickr_user">Flickr User</label>
			<div class="controls">
				<input value="<?= setting('site_share_flickr_user') ?>" type="text" name="site_share_flickr_user" id="site_share_flickr_user" class="text" />
			</div>
		</section>
		
		<section class="control-group">
			<label class="control-label" for="site_share_twitter">Twitter</label>
			<div class="controls">
				<input value="<?= setting('site_share_twitter') ?>" type="text" name="site_share_twitter" id="site_share_twitter" class="text" />
			</div>
		</section>
		
		<section class="control-group">
			<label class="control-label" for="site_share_facebook">Facebook</label>
			<div class="controls">
				<input value="<?= setting('site_share_facebook') ?>" type="text" name="site_share_facebook" id="site_share_facebook" class="text" />
			</div>
		</section>		
	</fieldset>
	
	<fieldset>
		<legend>Site Colors</legend>
		<section class="control-group">
			<label class="control-label">Race Headings</label>
			<div class="controls">
				<input value="<?= setting('color_a') ?>" type="text" class="color" name="color_a">
			</div>
		</section>
		<section class="control-group">
			<label class="control-label">Nav and Links</label>
			<div class="controls">
				<input value="<?= setting('color_b') ?>" type="text" class="color" name="color_b">
			</div>
		</section>
		<section class="control-group">
			<label class="control-label">Series Headings</label>
			<div class="controls">
				<input value="<?= setting('color_c') ?>" type="text" class="color" name="color_c">
			</div>
		</section>
		<section class="control-group">
			<label class="control-label">Extra</label>
			<div class="controls">
				<input value="<?= setting('color_d') ?>" type="text" class="color" name="color_d">
			</div>
		</section>		
	</fieldset>
	
	<fieldset>
		<section class="form-actions">
				<button type="submit" class="submit btn btn-primary">Save Site Settings</button>
		</section>

		<section class="control-group">
			<label class="control-label">Export Database</label>
			<div class="controls">
				<?= anchor('admin/site/export', "Download Archive", 'class="btn btn-small"'); ?>
			</div>
		</section>
	</fieldset>
</form>

<?php $this->load->footer(); ?>