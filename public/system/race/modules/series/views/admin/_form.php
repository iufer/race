<?= form_open_multipart($form_action, array('class'=>'form-horizontal')); ?>
	
<fieldset>
	<section class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" class="span6" name="name" id="series_name" value="<?= set_value('name', $name) ?>" required="required" />
			<?= form_error('name') ?>
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label" for="url">URL Name</label>
		<div class="controls">
			<input type="text" class="span4" name="url" id="series_url" value="<?= set_value('url', $url) ?>" />
			<?= form_error('url') ?>
		</div>
	</section>
	
	<section class="control-group">
		<label class="control-label" for="subtitle">Subtitle</label>
		<div class="controls">
			<input type="text" class="span6" name="subtitle" id="series_subtitle" value="<?= set_value('subtitle', $subtitle) ?>" />
			<?= form_error('subtitle') ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="description">Description</label>
		<div class="controls">
			<textarea name="description" id="series_description" class="html span6"><?= set_value('description', $description) ?></textarea>
			<?= form_error('description') ?>
		</div>
	</section>

	<script type="text/javascript" charset="utf-8">
		require(['jquery','jqueryui'], function($){
			
			$("#series_date_start_field").css('width','250')
					.datepicker({
						dateFormat: 'DD, MM d, yy',
						altField: "#series_date_start",
						altFormat: "yy-mm-dd"
					});
			$("#series_date_end_field" ).css('width','250')
					.datepicker({
						dateFormat: 'DD, MM d, yy',
						altField: "#series_date_end",
						altFormat: "yy-mm-dd"
					});					
		
			$('#series_date_start_field').datepicker('setDate', "<?= set_value('date_start', date('l, F j, Y', $date_start)) ?>");
			$('#series_date_end_field').datepicker('setDate', "<?= set_value('date_end', date('l, F j, Y', $date_end)) ?>");
			
		});
	</script>

	<section class="control-group">
		<label class="control-label" for="date_start">Start Date</label>
		<div class="controls">
			<input type="hidden" name="date_start" id="series_date_start" />
			<input type="text" id="series_date_start_field" />
			<?= form_error('date_start') ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="date_end">End Date</label>
		<div class="controls">
			<input type="hidden" name="date_end" id="series_date_end" />
			<input type="text" id="series_date_end_field" />
			<?= form_error('date_end') ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label" for="">Races</label>
		<div class="controls">
			<?php echo Modules::run('race/race_block/selector', $races); ?>
		</div>
	</section>
	
	<section class="form-actions">
			<button type="submit" class="submit btn btn-primary"><?= $form_submit ?></button>
			<a href="<?= site_url("admin/series") ?>" class="btn">Cancel</a>
			<?php if(isset($form_view)) {
				echo anchor_popup("series/{$series->series_url}", "View", array('class'=>'btn btn-success','width'=>1100, 'height'=>600));
				}
			?>
			<?php if(isset($form_delete)): ?>
			<a href="<?= site_url($form_delete) ?>" class="btn btn-danger pull-right">Delete</a>
			<?php endif; ?>
	</section>
	
</fieldset>
</form>