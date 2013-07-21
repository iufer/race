<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_block extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('course_model');
	}
	
	public function selector($course_id){
		if($course_id) {
			$default_course = $this->course_model->load($course_id);
		}
		else $default_course = false;
		
		$courses = $this->course_model->loadAll();
		return $this->load->view('course/block/selector', array('courses'=>$courses, 'default'=>$default_course), true);
	}
	
	public function map($course_url, $width = '100%', $height = '350px'){
		
		return $this->load->view('course/block/map', array('course_url'=>$course_url, 'width'=>$width, 'height'=>$height), true);
	}
}