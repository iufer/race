<?php
$this->load->addCSS('race/add.css');
$this->load->header('Create a new Course', 'course_add');
requirejs('views/course.add');

?>
<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/course", "Courses") ?> <span class="divider">/</span></li>  
  <li>New Course</li>
</ul>
<h2 class="heading-underline">New Course</h2>

<?php
$data = array(
	'form_action' => 'admin/course/add',
	'name' => null,
	'url' => null,
	'description' => null,
	'kml' => null,
	'miles' => 0,
	'elevation' => 0,
	'category_climb' => 0,
	'form_submit' => "Create Course"
);

$this->load->view('course/admin/_form', $data);

$this->load->footer();