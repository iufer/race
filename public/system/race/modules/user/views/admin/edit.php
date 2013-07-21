<?php 
$this->load->header('Edit User', 'user_edit');
requirejs('views/admin.form');

$flash = $this->session->flashdata('updated');
if($flash) {
	echo "<div class='alert info'>$flash</div>";
}
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/user", "Users") ?> <span class="divider">/</span></li>
  <li>Edit</li>
</ul>
<h2 class="heading-underline">Edit User</h2>

<?php
echo validation_errors();

$data = array(
	'form_action' => 'admin/user/edit/'. $user->user_id,
	'email' => $user->user_email,
	'name' => $user->user_name,
	'password' => $user->user_password,
	'form_submit' => 'Save User',
	'form_delete' => 'admin/user/del/'. $user->user_id
);

$this->load->view('user/admin/_form', $data);


$this->load->footer();