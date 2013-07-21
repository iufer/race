<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends MX_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('course_model');
	}
	
	public function index() {		
		$this->load->helper('html');
		$courses = $this->course_model->loadAll();
		$this->load->view('course/index', array('courses'=>$courses));
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);		
		
	}
	
	public function view($course_url = false){
		$this->load->helper('course');
		
		$course = $this->course_model->loadByUrl($course_url);
		if(! $course ){
			show_404();
		}
		else {			
			$this->load->view('course/view', array('course'=>$course));
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);		
				
		}
	}
	
	public function kml($course_url = false, $rand = 0){		
		$course = $this->course_model->loadByUrl($course_url);
		if($course->course_kml == ''){
			echo "No KML file specified";
			// pr($course);
		}
		else {
			$kml_path = FCPATH .'tmp/course/'. $course->course_kml;
			if(file_exists($kml_path)){
				// echo $kml_path;			
				$this->output->set_content_type('text/xml');
				$kml_file = file_get_contents($kml_path);
				$kml_file = str_replace('http://earth.google.com/images/kml-icons/track-directional/track-none.png', site_url("img/blank.png"), $kml_file);
				$kml_file = str_replace('http://maps.google.com/mapfiles/kml/pal4/icon61.png', site_url("img/blank.png"), $kml_file);
				$kml_file = str_replace('99ffac59', '7f0000ff', $kml_file);
				$kml_file = str_replace('<width>5</width>','<width>6</width>', $kml_file);
				$this->output->set_output($kml_file);
			}
			else {
				echo "No KML file found";
			}
		}
	}
		
}