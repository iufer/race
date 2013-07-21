<?php 
$this->load->header('Rider Settings', 'rider_settings'); 
requirejs('views/admin.form');
// requirejs('views/rider.settings');
?>
<style type="text/css" media="screen">
	#rider_categories { margin-left:0; }
	#rider_categories li { list-style:none; margin-bottom:5px;}
</style>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/rider", "Riders") ?> <span class="divider">/</span></li>
  <li>Settings</li>
</ul>
<h2 class="heading-underline">Rider Settings</h2>

<ul class="nav nav-tabs">
  <li class="active"><a href="#settings" data-toggle="tab">Rider Settings</a></li>
  <li><a href="#categories" data-toggle="tab">Rider Categories</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="settings">
		<?= form_open('admin/rider/settings', array('class'=>'form-horizontal')); ?>
		<fieldset>
			<section class="control-group">
				<label class="control-label">Anonymous Rider Name</label>
				<div class="controls">
					<input type="text" name="rider_anon_name" id="rider_anon_name" value="<?= setting('rider_anon_name'); ?>" />
				</div>
			</section>
			
			<section class="control-group">
				<label class="control-label">Rider Podium Places</label>
				<div class="controls">
					<input type="number" name="integer rider_podium_places" class="span1" id="rider_podium_places" value="<?= setting('rider_podium_places') ?>" />
				</div>
			</section>
			
			<section class="form-actions">
					<button type="submit" class="submit btn btn-primary">Save Rider Settings</button>
					<a class="btn" href="<?= site_url("admin/rider") ?>">Cancel</a>
			</section>
			
		</fieldset>
		</form>
	</div>

	<div class="tab-pane" id="categories">
		<?= form_open("admin/rider_category/add", array('class'=>'form-horizontal', 'id'=>'new_rider_category')); ?>
		<fieldset>
			<section class="control-group">
				<label class="control-label">Edit Categories</label>
				<div class="controls">
					<ul id="rider_categories">
					<?php
						foreach($rider_categories as $rider_category){
							printf('<li class="rider_category"><div class="input-append"><input class="rider_category_name span3" type="text" name="rider_category_name" value="%2$s" data-rider-category-id="%1$s" /><button type="button" class="btn rider_category_delete" data-rider-category-id="%1$s"><i class="icon-trash"></i></button></div></li>',
									$rider_category->rider_category_id,
									$rider_category->rider_category_name
								);			
						}
					?>
						<li class="rider_category"><div class="input-append"><input class="rider_category_name span3" type="text" name="rider_category_name" /><button type="button" class="btn"><i class="icon-plus"></i></button></div></li>
					</ul>					
				</div>
			</section>
			<section class="form-actions">
					<button type="submit" class="submit btn btn-primary">Save Rider Categories</button>
					<a class="btn" href="<?= site_url("admin/rider") ?>">Cancel</a>
			</section>
	
		</fieldset>
		</form></div>
</div>
<?php $this->load->footer(); ?>