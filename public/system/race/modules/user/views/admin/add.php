<?php 
$this->load->header('Add User', 'user_add');
requirejs('views/admin.form');

$flash = $this->session->flashdata('updated');
if($flash) {
	echo "<div class='alert info'>$flash</div>";
}
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/user", "Users") ?> <span class="divider">/</span></li>
  <li>Add</li>
</ul>
<h2 class="heading-underline">New User</h2>

<?php
echo validation_errors();

$data = array(
	'form_action' => 'admin/user/add/',
	'email' => null,
	'name' => null,
	'password' => null,
	'form_submit' => 'Create User'
);

$this->load->view('user/admin/_form', $data);


$this->load->footer();