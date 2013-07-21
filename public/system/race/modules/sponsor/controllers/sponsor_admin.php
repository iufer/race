<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sponsor_admin extends RA_Controller {

	public $loginRequired = true;	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('sponsor/sponsor_model');
	}
	
	public function index(){
		$sponsors = $this->sponsor_model->loadAll();
		$this->load->view('sponsor/admin/index', array('sponsors'=>$sponsors));
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);		
	}
	
	public function add(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run('admin/sponsor/add') == FALSE){
			$this->load->view('sponsor/admin/add');
		}
		else {
			$this->sponsor_model->sponsor_name = $this->input->post('name');
			$this->sponsor_model->sponsor_link = $course_url = $this->input->post('link');
			$this->sponsor_model->sponsor_description = $this->input->post('description');

			// Upload the Image
			$this->load->module('image');
			$this->sponsor_model->sponsor_image_id = $this->image->upload('image');
			
			// Save
			$sponsor_id = $this->sponsor_model->save();
			
			$this->session->set_flashdata('updated', 'Sponsor was saved.');
			
			redirect("admin/sponsor/edit/$sponsor_id");
		}
	}
	
	public function edit($sponsor_id) {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run('admin/sponsor/add') == FALSE){
			$sponsor = $this->sponsor_model->load($sponsor_id);
			$this->load->view("sponsor/admin/edit", array('sponsor'=>$sponsor));
		}
		else {
			$this->sponsor_model->sponsor_id = $sponsor_id;
			$this->sponsor_model->sponsor_name = $this->input->post('name');
			$this->sponsor_model->sponsor_link = $course_url = $this->input->post('link');
			$this->sponsor_model->sponsor_description = $this->input->post('description');

			// Upload the Image
			$this->load->module('image');
			$this->sponsor_model->sponsor_image_id = $this->image->upload('image');

			$this->sponsor_model->update();
			
			$this->session->set_flashdata('updated', 'Sponsor was saved.');

			redirect("admin/sponsor/edit/". $sponsor_id);
		}
	}
	
	
	public function del($sponsor_id){
		$this->sponsor_model->deleteById($sponsor_id);
		
		// unattach any races bound to this sponsor
		$this->load->model('race/race_model');
		$this->race_model->setSponsorIdNull($sponsor_id);
		
		$data = array('error' => false);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
	}
}