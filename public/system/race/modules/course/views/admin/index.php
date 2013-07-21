<?php 
$this->load->header('Course Index', 'course_index');
requirejs('views/course.index');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li>Courses</li>
</ul>
<h2 class="heading-underline">Course Index</h2>

<?php 

$thead = array(
	array(
		array('th' => 'Name'),
		array('th' => 'Miles'),
		array('th' => 'Elevation'),
		array('th' => 'Actions')
	)
);

$tbody = array('attr' => array('class' => 'table-condensed'));
foreach($courses as $course){
	$tbody[] = array(
		array('td' => anchor("admin/course/edit/{$course->course_id}", $course->course_name)),
		array('td' => formatMiles($course->course_miles)),
		array('td' => formatElevation($course->course_elevation)),
		array('td' => $this->load->view('admin/_actions', $course, true))
	);
}

echo buildTable($tbody, $thead, 'table table-bordered table-striped');

$this->load->footer();