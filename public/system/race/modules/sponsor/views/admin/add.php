<?php 
$this->load->header('New Sponsor', 'sponsor_add');
requirejs('views/admin.form');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/sponsor", "Sponsors") ?> <span class="divider">/</span></li>
  <li>New Sponsor</li>
</ul>
<h2 class="heading-underline">New Sponsor</h2>

<?php
echo validation_errors();

$data = array(
	'form_action' => 'admin/sponsor/add',
	'name' => null,
	'link' => null,
	'description' => null,
	'image_path' => null,
	'form_submit' => "Create Sponsor"
);

$this->load->view('sponsor/admin/_form', $data);

$this->load->footer();