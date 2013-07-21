<?php 
$this->load->header('Message Index', 'message_index');
requirejs('views/message.index');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li>Messages</li>
</ul>
<h2 class="heading-underline">Messages Index</h2>

<?php
if( count($messages) > 0) {
	$thead = array(
		array(
			array('th' => "Title"),
			array('th' => "Message"),
			array('th' => "Expires"),
			array('th' => "Posted By"),
			array('th' => "Actions")
		)
	);
	$tbody = array('attr' => array('class' => 'table-condensed'));
	foreach($messages as $message){
		$message_status = (mysql_to_unix($message->message_date_expires) < time()) ? 'Expired' : date('Y m d', mysql_to_unix($message->message_date_expires));
		$tbody[] = array(
			array('td' => anchor("admin/message/edit/{$message->message_id}", $message->message_title)),
			array('td' => $message->message_message),
			array('td' => $message_status),
			array('td' => $message->user_name),
			array('td' => $this->load->view('admin/_actions', $message, true))
		);
	}
}
else {
	$thead = null;
	$tbody = array(array(array('td' => 'No Messages')));
}
echo buildTable($tbody, $thead, 'table table-bordered table-striped');

$this->load->footer();