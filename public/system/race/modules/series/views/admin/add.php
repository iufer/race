<?php 
$this->load->header('Create a new Series', 'series_add');
requirejs('views/admin.form', 'views/series.add');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/series", "Series") ?> <span class="divider">/</span></li>
  <li>New Series</li>
</ul>
<h2 class="heading-underline">New Series</h2>

<?php
$data = array(
	'form_action'=> 'admin/series/add',
	'name' => null,
	'url' => null,
	'subtitle' => null,
	'description' => null,
	'date_start' => time(),
	'date_end' => time(),
	'races' => null,
	'form_submit' => 'Create Series'
);

$this->load->view('series/admin/_form', $data);

$this->load->footer();