<?php
$this->load->addCSS('race/add.css');
$this->load->header('Edit Course', 'course_edit');
requirejs('views/course.add');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/course", "Courses") ?> <span class="divider">/</span></li>  
  <li>Edit Course</li>
</ul>
<h2 class="heading-underline"><?= $course->course_name ?></h2>

<?php
$flash = $this->session->flashdata('updated');
if($flash) {
	echo "<div class='alert info'>$flash</div>";
}

$data = array(
	'form_action' => "admin/course/edit/{$course->course_id}",
	'name' => $course->course_name,
	'url' => $course->course_url,
	'description' => $course->course_description,
	'kml' => $course->course_kml,
	'miles' => $course->course_miles,
	'elevation' => $course->course_elevation,
	'category_climb' => $course->course_category_climb,
	'form_submit' => "Save Course",
	'form_delete' => "admin/course/del/{$course->course_id}"
);

$this->load->view('course/admin/_form', $data);

$this->load->footer();