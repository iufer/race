<?php 
$this->load->header('Sponsor Index', 'sponsor_index');
requirejs('views/sponsor.index');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li>Sponsors</li>
</ul>
<h2 class="heading-underline">Sponsors Index</h2>

<?php
if( count($sponsors) > 0) {
	$thead = array(
		array(
			array('th' => "Name"),
			array('th' => "Logo"),
			array('th' => "Actions")
		)
	);
	$tbody = array('attr' => array('class' => 'table-condensed'));
	foreach($sponsors as $sponsor){
		$tbody[] = array(
			array('td' => anchor("admin/sponsor/edit/{$sponsor->sponsor_id}", $sponsor->sponsor_name) ),
			array('td' => "<img src=\"{$sponsor->image_path}\" class='img-polaroid' style='height:50px;' />"),
			array('td' => $this->load->view('admin/_actions', $sponsor, true))
		);
	}
}
else {
	$thead = null;
	$tbody = array(array(array('td' => 'No Sponsors')));
}
echo buildTable($tbody, $thead, 'table table-bordered table-striped');

$this->load->footer();