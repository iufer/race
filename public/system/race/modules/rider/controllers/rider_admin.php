<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rider_admin extends RA_Controller {

	public $loginRequired = true;

	public function __construct(){
		parent::__construct();
		$this->load->model('rider/rider_model');
		$this->rider_model->setDoPostProcessing(false);		
	}
	
	public function index() {		
		$this->load->helper('html');
				
		$data = array('riders' => $this->rider_model->loadAllInOrder());
		
		$this->load->view('rider/admin/index', $data);
	}
	
	public function edit($rider_id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');			
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run('admin/rider/edit') == FALSE){
			$this->load->model('rider_category/rider_category_model');			
			$data = array(
				'rider'=>$this->rider_model->load($rider_id), 
				'rider_categories'=> $this->rider_category_model->listAll()
				);
			$this->load->view('rider/admin/edit', $data);
		}
		else {
			$this->rider_model->rider_id = $rider_id;
			$this->rider_model->rider_name = $this->input->post('name');
			$this->rider_model->rider_public = $this->input->post('public');
			$this->rider_model->rider_rider_category_id = $this->input->post('rider_category_id');
			
			$this->rider_model->update();
			$this->session->set_flashdata('updated', 'Rider was saved.');			
			redirect("admin/rider/edit/$rider_id");			
		}
	}

	public function settings(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$config = array(
		               array(
		                     'field'   => 'rider_anon_name', 
		                     'label'   => 'Anonymous rider name', 
		                     'rules'   => 'required'
		                  ),
		               array(
		                     'field'   => 'rider_podium_places', 
		                     'label'   => 'Rider podium places', 
		                     'rules'   => 'required'
		                  )
		            );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->preset_value('rider_anon_name', setting('rider_anon_name'));
			$this->form_validation->preset_value('rider_podium_places', setting('rider_podium_places'));
			
			$this->load->model('rider_category/rider_category_model');
			$rider_categories = $this->rider_category_model->loadAll();
			
			$this->load->view('rider/admin/settings', array('rider_categories'=>$rider_categories));		

		}
		else
		{
			$this->setting_model->update('rider_anon_name', $this->input->post('rider_anon_name'));	
			$this->setting_model->update('rider_podium_places', $this->input->post('rider_podium_places'));

			$this->session->set_flashdata('updated', 'Rider settings saved.');
			redirect("admin/rider/settings");
		}		
	}
	
	public function del($rider_id){
		$this->load->model('result/result_model');

		$this->rider_model->deleteById($rider_id);
		$this->result_model->deleteByRiderId($rider_id);
		
		$data = array('error' => false);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
	}
}