<?php 
$this->load->addCSS('race/add.css');
$this->load->header('Create a new Race', 'race_add');
requirejs('views/admin.form','views/race.add');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/race", "Races") ?></li> <span class="divider">/</span></li>
  <li>New Race</li>
</ul>

<h2 class="heading-underline">New Race</h2>

<?php
echo validation_errors();

// FORM FIELDS
$data = array(
	'form_action' => 'admin/race/add',
	'name' => null,
	'subtitle' => null,
	'start_date' => time(),
	'start_time' => mktime(18, 0, 0, 0, 0, 0),
	'registration_date' => time(),
	'registration_time' => mktime(17, 45, 0, 0, 0, 0),
	'description' => null,
	'race_type_id' => setting('race_default_race_type_id'),
	'race_status_id' => setting('race_default_race_status_id'),
	'course_id' => setting('race_default_course_id'),
	'laps' => setting('race_default_laps'),
	'point_bracket' => setting('race_default_uses_point_bracket'),
	'point_bracket_multiplier' => null,
	'sponsor_id' => null,
	'form_submit' => "Create Race"
);

$this->load->view('race/admin/_form', $data);


$this->load->footer();