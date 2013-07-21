<?php 
$this->load->addCSS('admin/jquery.miniColors.css');
$this->load->header('Race Settings', 'race_settings');
requirejs('views/admin.form','views/course.selector');
?>

<style type="text/css" media="screen">
	#race_types_sortable { margin-left:0; }
	#race_types_sortable li.race_type { margin-bottom:5px; list-style:none;}
</style>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/race", "Races") ?></li> <span class="divider">/</span></li>
  <li>Race Settings</li>
</ul>
<h2 class="heading-underline">Race Settings</h2>

<?php
$flash = $this->session->flashdata('updated');
if($flash) { echo "<div class='alert info'>$flash</div>"; }
?>

<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#defaults" data-toggle="tab">New Race Defaults</a></li>
  <li><a href="#types" data-toggle="tab">Race Types</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="defaults">
		<?= form_open("admin/race/settings", array('class'=>'form-horizontal')) ?>
		<fieldset>
			<section class="control-group">
				<label class="control-label">Course</label>
				<div class="controls">
					<?= Modules::run('course/course_block/selector', setting('race_default_course_id') ); ?>
				</div>
			</section>
			
			<section class="control-group">
				<label class="control-label">Laps</label>
				<div class="controls">
					<input type="number" name="race_default_laps" value="<?= setting('race_default_laps') ?>" class="span1 integer" />
				</div>
			</section>
			
			<section class="control-group">
				<label class="control-label">Uses points bracket?</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="point_bracket" value="1" id="point_bracket_yes" <?= (setting('race_default_uses_point_bracket') == 1) ? 'checked="checked"' : "" ?> /> Yes
					</label>			
					<label class="radio inline">
						<input type="radio" name="point_bracket" value="0" id="point_bracket_no" <?= (setting('race_default_uses_point_bracket') == 0) ? 'checked="checked"' : "" ?> /> No
					</label>
				</div>
			</section>
			
			<section class="control-group">
				<label class="control-label">Race Type</label>
				<div class="controls">
					<?= Modules::run('race_type/race_type_block/selector', setting('race_default_race_type_id') ); ?>
				</div>
			</section>
			
			<section class="control-group">
				<label class="control-label">Race Status</label>
				<div class="controls">
					<?= Modules::run('race_status/race_status_block/selector', setting('race_default_race_status_id') ); ?>
				</div>
			</section>
			
			<section class="form-actions">
					<button type="submit" class="submit btn btn-primary">Save Race Defaults</button>
			</section>
			
		</fieldset>
		</form>
	</div>

	<div class="tab-pane" id="types">
		<?= form_open("admin/race_type/reorder", array('class'=>'form-horizontal', 'id'=>'race_types_edit')); ?>			
		<fieldset>
			<section class="control-group">
				<label class="control-label">Edit Race Types</label>
				<div class="controls">
					<ul id="race_types_sortable">
					<?php
						foreach($race_types as $i=>$race_type){
							printf('<li data-race-type-id="%1$s" class="race_type"><input class="race_type_description" type="text" name="race_type_description" value="%2$s" data-race-type-id="%1$s" /> <input value="" type="text" class="color span1" name="%1$s"></li>',
									$race_type->race_type_id,
									$race_type->race_type_description
								);
						}
					?>
						<!-- <li class="input-append race_type"><input class="race_type_description" type="text" name="race_type_description" placeholder="" /><button class="btn" type="button"><i class="icon-plus"></i></button></li> -->
					</ul>
				</div>
			</section>
			<section class="form-actions">
					<button type="submit" class="submit btn btn-primary">Save Race Types</button>
			</section>	
		</fieldset>
		</form>
	</div>
</div>

<?php $this->load->footer(); ?>