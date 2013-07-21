<?php 
$this->load->header('Create a new Message', 'message_add');
requirejs('views/admin.form','views/message.add');
?>
<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/message", "Messages") ?> <span class="divider">/</span></li>
  <li>New Messages</li>
</ul>
<h2 class="heading-underline">New Message</h2>

<?php
echo validation_errors();

$data = array(
	'form_action' => 'admin/message/add',
	'title' => null,
	'message' => null,
	'date_expires' => time(),
	'form_submit' => "Post Message"
);

$this->load->view('message/admin/_form', $data);

$this->load->footer();