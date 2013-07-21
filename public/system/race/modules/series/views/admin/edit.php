<?php 
$this->load->header('Editing Series', 'series_edit');
requirejs('views/admin.form', 'views/series.add');
?>
<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/series", "Series") ?> <span class="divider">/</span></li>
  <li>Edit Series</li>
</ul>
<h2 class="heading-underline"><?= $series->series_name ?></h2>

<?php
$flash = $this->session->flashdata('updated');
if($flash) {
	echo "<div class='alert info'>$flash</div>";
}

$data = array(
	'form_action'=> "admin/series/edit/{$series->series_id}",
	'name' => $series->series_name,
	'url' => $series->series_url,
	'subtitle' => $series->series_subtitle,
	'description' => $series->series_description,
	'date_start' => mysql_to_unix($series->series_date_start),
	'date_end' => mysql_to_unix($series->series_date_end),
	'races' => $races,
	'form_submit' => 'Save Series',
	'form_view' => "series/{$series->series_url}",
	'form_delete' => "admin/series/del/{$series->series_id}"
);

$this->load->view('series/admin/_form', $data);

$this->load->footer();