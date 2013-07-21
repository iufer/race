<?php 
$this->load->header('Series Index', 'series_index');
requirejs('views/series.index');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li>Series</li>
</ul>
<h2 class="heading-underline">Series Index</h2>

<?php

$thead = array(
	array(
		array('th' => "Name"),
		array('th' => "Dates"),
		array('th' => "Actions")
	)
);
$tbody = array('attr' => array('class' => 'table-condensed'));

foreach($series as $s){
	$tbody[] = array(
		array('td' => anchor("admin/series/edit/{$s->series_id}", $s->series_name)),
		array('td' => date("F j", mysql_to_unix($s->series_date_start)) ." &ndash; ". date("F j, Y", mysql_to_unix($s->series_date_end)) ),
		array('td' => $this->load->view('admin/_actions', $s, true))
	);
}			
	
echo buildTable($tbody, $thead, 'table table-bordered table-striped');

$this->load->footer();