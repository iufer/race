<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_course_kml extends CI_Migration {
	
	function up(){
		echo "Adding col: course_kml<br>";
		$this->dbforge->add_column('course', array(
			'course_kml' => array('type'=>'VARCHAR', 'constraint'=>512)	
		));
		
		echo "Remove col: course_map_embed, course_bikely_url";
		$this->dbforge->drop_column('course', 'course_map_embed');
		$this->dbforge->drop_column('course', 'course_bikely_url');
		
		mkdir(FCPATH .'tmp/course/');
	}
	
	function down(){
		echo "would like to restore map embed and bikely url, but not going to do it!";
	}
}