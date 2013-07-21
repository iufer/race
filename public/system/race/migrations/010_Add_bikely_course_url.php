<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_bikely_course_url extends CI_Migration {
	
	function up(){
		echo "Adding column: course_bikely_url<br>";
		$this->dbforge->add_column('course', array(
			'course_bikely_url' => array('type'=>'VARCHAR', 'constraint'=>512)	
		));
	}
	
	function down(){
		echo "drop column 'course.course_bikely_url'";
		$this->dbforge->drop_column('course', 'course_bikely_url');		
	}
}