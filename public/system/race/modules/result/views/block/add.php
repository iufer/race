<script type="text/javascript" charset="utf-8">
	require(['views/result.add']);
</script>

<?php
echo form_open_multipart('admin/result/add', array('id'=>'form_result_add'));
echo form_hidden('race_id', set_value('race_id', $race->race_id));
?>

	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a id="tab-single" class="default" data-target="#single" data-toggle="tab">Single Rider</a></li>
			<li><a id="tab-global" data-target="#all" data-toggle="tab">All Riders</a></li>
			<li><a id="tab-special" data-target="#special" data-toggle="tab">Special</a></li>
		</ul>
	
		<!-- Set this when changing tabs -->
		<input type="hidden" name="result_scope_global" id="result_scope_global" value="0" />
		
		<div class="tab-content">
			<div id="single" class="tab-pane result_rider_info">
				<div class="row">
					<div class="span2">
						<label>Rider Name *</label>
						<input class="span2" type="text" name="rider_name" id="rider_name" value="<?= set_value('rider_name') ?>" />
					</div>
					<div class="span1">
						<label>ID</label>
						<input class="span1" type="text" name="rider_id" value="<?= set_value('rider_id') ?>" id="rider_id">
					</div>
					<div class="span3">
						<label class="gray4">Category *</label>
						<?php
							echo form_dropdown('rider_category_id', $rider_categories, set_value('rider_category_id'), 'id="rider_category_id" class="span2"');		
						?>
						<a class="btn btn-mini"><i class="icon-lock"></i> Lock</a>
					</div>
				</div>
			</div>
			<div id="all" class="tab-pane result_global">
				<div class="row">
					<div class="span6"><p>Adding result to all riders.</p></div>
				</div>
			</div>

			<div id="special" class="tab-pane result_special">
				<div class="row">
					<div class="span6">
						<?= anchor("admin/race/createPlacingsByTime/$race->race_id", 'Create rider placings based on time', 'id="create_placings" class="btn"') ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row" id="result_data_entry">
		<div class="span9">
			<table class="table table-bordered table-striped table-condensed">
				<thead><tr><th>Type</th><th>Data</th><th>Note</th><th>&nbsp;</th></t></thead>
				<tbody id="result_data_entries">
					<tr id="result_data_entry" class="result_data_entry">
						<td>
							<?php echo form_dropdown('result_type_id[]', $result_types, 3, 'class="result_type_id span3"'); ?>
						</td>
						<td>
							<input type="text" name="data[]" value="<?= set_value('data') ?>" class="result_data_field span2">
						</td>
						<td>
							<input type="text" name="note[]" value="<?= set_value('note') ?>" class="result_note_field span3">
						</td>
						<td class="actions">
							<a id="add_data_row" class="result_data_new btn btn-small"><i class="icon-plus"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row" id="result_data_submit">
		<div class="span7">
			<div id="form_error" class="alert" style="display:none;"><span class="alert-content"></span></div>
			&nbsp;
		</div>
		<div class="span2">
			<button class="btn btn-primary" type="submit">Submit <img height="12" src="<?= site_url('img/admin/loading.gif'); ?>" id="submit_result_loading" style="display:none;" /></button>
		</div>
	</div>

	<div id="result_edit" class="modal"></div>		
</form>
