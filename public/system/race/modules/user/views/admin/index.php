<?php 
$this->load->header('User Index', 'user_index');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li>Users</li>
</ul>
<h2 class="heading-underline">Admin Users</h2>
<?php

echo "<p>These users have access to this admin control panel.</p>";

$thead = array(
	array(
		array('th' => 'Name'),
		array('th' => 'Email'),
		array('th' => 'Actions', 'attr' => array('colspan' => 2))
	)
);

$tbody = array('attr' => array('class' => 'table-condensed'));

foreach($users as $user){
	$tbody[] = array(
		array('td' => anchor("admin/user/edit/{$user->user_id}", $user->user_name )),
		array('td' => anchor("admin/user/edit/{$user->user_id}", $user->user_email )),
		array('td' => $this->load->view('admin/_actions', $user, true))
	);
}

echo buildTable($tbody, $thead, 'table table-bordered table-striped');			

echo anchor('admin/user/add', "Add New User", 'class="btn btn-primary btn-small"');

$this->load->footer();