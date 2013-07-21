
<?= form_open($form_action, array('class'=>'form-horizontal')); ?>

<fieldset>
	<section class="control-group">
		<label class="control-label">Title</label>
		<div class="controls">
			<input type="text" name="title" id="message_title" class="span6" value="<?= set_value('title', $title) ?>" required />
			<?= form_error('title'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Message</label>
		<div class="controls">
			<textarea name="message" id="message_message" class="html span6"><?= set_value('message', $message) ?></textarea>
			<?= form_error('message'); ?>
		</div>
	</section>

	<section class="control-group">
		<label class="control-label">Expires?</label>
		<div class="controls">
			<input type="checkbox" id="expires" />
			<script type="text/javascript" charset="utf-8">
				require(['jquery'], function($){
					$('#expires').bind('change', function(){
						$('#expires_section').toggle();
					});
					$('#expires_section').hide();
				});
			</script>
		</div>
	</section>
		
	<section class="control-group" id="expires_section">
		<label class="control-label">Expiration Date</label>
		<div class="controls">
			<?php
				
				echo form_input(array(
									'name'=>'date_expires',
									'id'=>'message_date_expires',
									'class'=>'date',
									'value'=>set_value('date_expires',  date('Y-m-d', $date_expires))
								));
				echo form_input(array(
									'name'=>'',
									'id'=>'message_time_expires_field',
									'class'=>'timepicker span2'
								));
				echo "<input type='hidden' name='time_expires' value='". set_value('time_expires', date('H:i:s', $date_expires)) ."' id='message_time_expires' />";
				echo "<span class='time_feedback'></span>";
				echo form_error('date_expires');
				echo form_error('time_expires');
			?>
		</div>
	</section>
	
	<section class="form-actions">
			<button type="submit" class="submit btn btn-primary"><?= $form_submit ?></button>
	</section>
	
</fieldset>
</form>
