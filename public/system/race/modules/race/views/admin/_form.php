<?= form_open_multipart($form_action, array('class'=>'form-horizontal')); ?>

<fieldset>
	<section class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" class="span6" name="name" id="race_name" value="<?= set_value('name', $name) ?>" required="required" />
			<?= form_error('name');	?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="subtitle">Subtitle</label>
		<div class="controls">
			<input type="text" class="span6" name="subtitle" id="race_subtitle" value="<?= set_value('subtitle', $subtitle) ?>" />
			<?= form_error('subtitle');	?>
		</div>
	</section>	
</fieldset>


<fieldset>
	<legend>Date and Time</legend>
	<section class="control-group">
		<label class="control-label">Start Date</label>
		<div class="controls">
			<script type="text/javascript" charset="utf-8">
				require(['jquery','jqueryui','helpers/date','plugins/jquery.ui.timepicker'], function($){
					
					$("#race_start_date_field")
							.css('width','250')
							.datepicker({
								dateFormat: 'DD, MM d, yy',
								altField: "#race_start_date",
								altFormat: "yy-mm-dd",
								onClose: function(dateText, inst){
									//console.log('set_reg_date');							
									$('#race_registration_date_field').datepicker('setDate', dateText);
								}
							});
					$("#race_registration_date_field" ).css('width','250')
							.datepicker({
								dateFormat: 'DD, MM d, yy',
								altField: "#race_registration_date",
								altFormat: "yy-mm-dd"
							});					
				
					$('#race_start_date_field').datepicker('setDate', "<?= set_value('start_date', date('l, F j, Y', $start_date)) ?>");
					$('#race_registration_date_field').datepicker('setDate', "<?= set_value('registration_date', date('l, F j, Y', $registration_date)) ?>");
					
				});
			</script>

			<input type="hidden" name="start_date" id="race_start_date" />
			<input type="text" id="race_start_date_field" value="" class="date span3" />			
						
			<input type="hidden" name="start_time" id="race_start_time" value="<?= set_value('start_time', date('H:i:s',$start_time)) ?>" />
			<input type="text" id="race_start_time_field" class="timepicker span2" />
			
			<?= form_error('start_date'); ?>
			<?= form_error('start_time'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Registration Date</label>
		<div class="controls">
			
			<input type="hidden" name="registration_date" id="race_registration_date" />
			<input type="text" id="race_registration_date_field" value="" class="date span3" />
			
			<input type="hidden" name="registration_time" id="race_registration_time" value="<?= set_value('registration_time', date('H:i:s',$registration_time)) ?>" />
			<input type="text" id="race_registration_time_field" class="timepicker span2" />
			
			<?= form_error('registration_date'); ?>
			<?= form_error('registration_time'); ?>
		</div>
	</section>
</fieldset>

<fieldset>
	<legend>Details</legend>
	
	<section class="control-group">
		<label class="control-label">Description</label>
		<div class="controls">
			<textarea name="description" id="race_description" class="html span6"><?= set_value('description', $description) ?></textarea>
			<?= form_error('description') ?>
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label">Type</label>
		<div class="controls">
			<?php
				echo Modules::run('race_type/race_type_block/selector', set_value('race_type_id', $race_type_id));
				echo form_error('race_type_id');			
			?>
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label">Status</label>
		<div class="controls">
			<?php
				echo Modules::run('race_status/race_status_block/selector', set_value('race_status_id', $race_status_id));
				echo form_error('race_status_id');			
			?>
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label">Course</label>
		<div class="controls">
			<?php
				echo Modules::run('course/course_block/selector', set_value('course_id', $course_id));
			?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Laps</label>
		<div class="controls">
			<input type="number" class="integer span1" name="laps" id="race_laps" value="<?= set_value('laps',$laps) ?>" />
			<?= form_error('laps'); ?>
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label">Uses Point Bracket?</label>
		<div class="controls">
			<?php
				echo form_dropdown('point_bracket', array('0'=>'No','1'=>'Yes'), set_value('point_bracket', $point_bracket), 'id="race_point_bracket" class="span1"');
				echo form_error('point_bracket');
			?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Point Multiplier</label>
		<div class="controls">
			<?php
				$pb = setting('race_point_bracket', true);
				$brackets = array();
				foreach($pb as $i=>$b){
					$brackets[$i] = $b->name ." [{$b->b[0]}, {$b->b[1]}, {$b->b[2]}, ...]";
				}
				echo form_dropdown('point_bracket_multiplier', $brackets, set_value('point_bracket_multiplier', $point_bracket_multiplier), 'id="race_point_bracket_multiplier"');
				echo form_error('point_bracket_multiplier');
			?>
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label">Sponsor</label>
		<div class="controls">
			<?php
				echo Modules::run('sponsor/sponsor_block/selector', set_value('sponsor_id', $sponsor_id));
			?>
		</div>
	</section>
	
	<section class="form-actions">
			<button type="submit" class="submit btn btn-primary"><?= $form_submit ?></button>
			<a href="<?= site_url("admin/race") ?>" class="btn">Cancel</a>
	</section>
</fieldset>
</form>
