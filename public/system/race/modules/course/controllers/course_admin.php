<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_admin extends RA_Controller {

	public $loginRequired = true;

	public function __construct(){
		parent::__construct();
		$this->load->model('course/course_model');
	}
	
	public function index() {		
		$this->load->helper('html');
		$data = array('courses'=>$this->course_model->loadAll());		
		$this->load->view('course/admin/index', $data);
	}
	
	public function add(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run('admin/course/add') == FALSE){
			$this->load->view('course/admin/add');
		}
		else {
			$this->course_model->course_name = $this->input->post('name');
			$this->course_model->course_url = $course_url = $this->input->post('url');
			$this->course_model->course_description = $this->input->post('description');
			$this->course_model->course_miles = $this->input->post('miles');
			$this->course_model->course_elevation = $this->input->post('elevation');
			$this->course_model->course_category_climb = $this->input->post('category_climb');

			// upload the KML file
			$uploaddir = FCPATH .'tmp/course/';
			$uploadname = basename($_FILES['kml']['name']);
			$uploadfile = $uploaddir . $uploadname;
			move_uploaded_file($_FILES['kml']['tmp_name'], $uploadfile);
			
			$this->course_model->course_kml = $uploadname;
			
			$course_id = $this->course_model->save();
			$this->session->set_flashdata('updated', 'Course was saved.');
			redirect("admin/course/edit/$course_id");
		}
	}
	
	public function edit($course_id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');			
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run('admin/course/add') == FALSE){
			$course = $this->course_model->load($course_id);				
			$data = array('course'=>$course);		

			$this->load->view('course/admin/edit', $data);
		}
		else {
			$this->course_model->course_id = $course_id;
			$this->course_model->course_name = $this->input->post('name');
			$this->course_model->course_url = $course_url = $this->input->post('url');
			$this->course_model->course_description = $this->input->post('description');
			$this->course_model->course_miles = $this->input->post('miles');
			$this->course_model->course_elevation = $this->input->post('elevation');
			$this->course_model->course_category_climb = $this->input->post('category_climb');

			if($_FILES['kml']['error'] !== UPLOAD_ERR_NO_FILE){
				// upload the KML file
				$uploaddir = FCPATH .'tmp/course/';
				$uploadname = basename($_FILES['kml']['name']);
				$uploadfile = $uploaddir . $uploadname;
				move_uploaded_file($_FILES['kml']['tmp_name'], $uploadfile);
			
				$this->course_model->course_kml = $uploadname;
			}
			else {
				// no file was uploaded
				$this->course_model->course_kml = -1;
			}
			
			$this->course_model->update();
			$this->session->set_flashdata('updated', 'Course was saved.');			
			redirect("admin/course/edit/$course_id");
		}		
		
	}
	
	public function del($course_id){
		$this->course_model->deleteById($course_id);
		
		$this->load->model('race/race_model');
		$this->race_model->setCourseIdNull($course_id);
		
		$data = array('error' => false);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
		
	}
	
}