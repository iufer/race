<?php
$this->load->addCSS('race/add.css');
$this->load->header('Edit Race', 'race_edit');
requirejs('views/admin.form','views/race.add');
?>

<script type="text/javascript" charset="utf-8">
	var race_id = "<?= $race->race_id ?>";
</script>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/race", "Races") ?></li> <span class="divider">/</span></li>
  <li>Edit Race</li>
</ul>
<h2 class="heading-underline"><?= $race->race_name ?></h2>

<?php
	$flash = $this->session->flashdata('updated');
	if($flash) echo "<div class='alert info'>$flash</div>";
?>

<div class="tabbable">
	<ul class="nav nav-tabs">
		<li><a class="default" data-target="#edit" data-toggle="tab">Edit</a></li>
		<li><a data-target="#results" data-toggle="tab">Results</a></li>
		<li><?php echo anchor_popup("race/{$race->race_url}", "<span>View</span>", array('width'=>990, 'height'=>600, 'class'=>'race_view')); ?>		</li>		
		<li><?php echo anchor("admin/race/duplicate/{$race->race_id}", "Duplicate", 'class="race_duplicate"'); ?>		</li>
		<li><?php echo anchor("admin/race/del/{$race->race_id}", "Delete", 'class="race_delete"'); ?></li>
	</ul>

	<div class="tab-content">
		<div id="edit" class="tab-pane">
			<?php 
				$data = array(
					'form_action' => "admin/race/edit/{$race->race_id}",
					'name' => $race->race_name,
					'subtitle' => $race->race_subtitle,
					'start_date' => mysql_to_unix($race->race_start_time),
					'start_time' => mysql_to_unix($race->race_start_time),
					'registration_date' => mysql_to_unix($race->race_registration_time),
					'registration_time' => mysql_to_unix($race->race_registration_time),
					'description' => $race->race_description,
					'race_type_id' => $race->race_race_type_id,
					'race_status_id' => $race->race_race_status_id,
					'course_id' => $race->race_course_id,
					'laps' => $race->race_laps,
					'point_bracket' => $race->race_point_bracket,
					'point_bracket_multiplier' => $race->race_point_bracket_multiplier,
					'sponsor_id' => $race->race_sponsor_id,
					'form_submit' => "Save Race"
				);

				$this->load->view('race/admin/_form', $data);
			?>

		</div>

		<div id="results" class="tab-pane">
			<h3>Add Results</h3>
			<?php echo Modules::run('result/result_block/add', $race->race_id, $race); ?>

			<span id="race_results_block">
			<?php echo Modules::run('result/result_block/race_admin', $race->race_id); ?>
			</span>
		
		</div>
	</div>
</div>

<?php $this->load->footer(); ?>