<?php 
$this->load->header('Edit Sponsor', 'sponsor_edit');
requirejs('views/admin.form');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/sponsor", "Sponsors") ?> <span class="divider">/</span></li>
  <li>Edit Sponsor</li>
</ul>
<h2 class="heading-underline"><?= $sponsor->sponsor_name ?></h2>

<?php
$flash = $this->session->flashdata('updated');
if($flash) echo "<div class='alert info'>$flash</div>";

echo validation_errors();

$data = array(
	'form_action' => "admin/sponsor/edit/{$sponsor->sponsor_id}",
	'name' => $sponsor->sponsor_name,
	'link' => $sponsor->sponsor_link,
	'description' => $sponsor->sponsor_description,
	'image_path' => $sponsor->image_path,
	'form_submit' => "Save Sponsor",
	'form_delete' => "admin/sponsor/del/{$sponsor->sponsor_id}"
);

$this->load->view('sponsor/admin/_form', $data);

$this->load->footer();