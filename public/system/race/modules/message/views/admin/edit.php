<?php 
$this->load->header('Edit new Message', 'message_edit');
requirejs('views/admin.form','views/message.add');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/message", "Messages") ?> <span class="divider">/</span></li>
  <li>Edit Message</li>
</ul>
<h2 class="heading-underline"><?= $message->message_title ?></h2>

<?php
$flash = $this->session->flashdata('updated');
if($flash) {
	echo "<div class='alert info'>$flash</div>";
}

echo validation_errors();

$data = array(
	'form_action' => "admin/message/edit/{$message->message_id}",
	'title' => $message->message_title,
	'message' => $message->message_message,
	'date_expires' => mysql_to_unix($message->message_date_expires),
	'form_submit' => "Save Message"
);

$this->load->view('message/admin/_form', $data);

$this->load->footer();