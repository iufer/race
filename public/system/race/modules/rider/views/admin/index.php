<?php 
$this->load->header('Rider Index', 'rider_index'); 
requirejs('views/rider.index');
?>
<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li>Riders Index</li>
</ul>
<h2 class="heading-underline">Riders Index</h2>

<?php
$thead = array(
	array(
		array('th' => "Rider ID"),
		array('th' => "Name"),
		array('th' => "Category"),
		array('th' => "Actions")
	)
);
$tbody = array('attr' => array('class' => 'table-condensed'));

foreach($riders as $rider){		
	$tbody[] = array(
		array('td' => anchor("admin/rider/edit/{$rider->rider_id}", formatRiderId($rider->rider_id)) ),
		array('td' => anchor("admin/rider/edit/{$rider->rider_id}", $rider->rider_name) ),
		array('td' => $rider->rider_category_name),
		array('td' => $this->load->view('admin/_actions', $rider, true))
	);
}	
echo buildTable($tbody, $thead, 'table table-bordered table-striped');

$this->load->footer();