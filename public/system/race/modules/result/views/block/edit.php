<?= form_open_multipart("admin/result/edit/{$result->result_id}", array('id'=>'form_result_edit')); ?>

	<h2>Editing result for <?= $result->rider_name ?> <?= formatRiderId($result->rider_id) ?> for <?= $result->race_name ?></h2>

	<div class="result_rider_info">
	<div class="gray4">Category</div>
	<?php
		//echo form_label('Category *','rider_category_id');
		echo form_dropdown('rider_category_id', $rider_categories, set_value('rider_category_id', $result->rider_category_id), 'id="rider_category_id"');		
	?>
	</div>

		<div class="grid_2 alpha taright">
			<div class="gray4">Type *</div>
			<?php echo form_dropdown('result_type_id', $result_types, set_value('result_type_id', $result->result_result_type_id), 'class="result_type_id"'); ?>
		</div>
		<div class="grid_2">
			<div class="gray4">Data *</div>
			<?php echo form_input(array(
								'name'=>'data',
								//'id'  =>'result_data',
								'class'=> 'result_data_field',
								'value' => set_value('data', $result->result_data),
								'size'=>15
								));
			?>
		</div>
		<div class="grid_4">
			<div class="gray4">Note </div>
			<?php echo form_input(array(
								'name'=>'note',
								//'id'  =>'result_data',
								'class'=> 'result_note_field w_80',
								'value' => set_value('note', $result->result_note)
								));
			?>			
		</div>

	<div id="form_error" class="taright">&nbsp;</div>
	<!-- <input type="submit" name="some_name" value="submit" id="some_name"> -->
</form>
