<?php

class User_admin extends RA_Controller {
	
	public $loginRequired = true;

	public function __construct(){
		parent::__construct();
		$this->load->model('user/user_model');
	}
	
	public function index() {		
		$this->load->helper('html');
				
		$data = array('users' => $this->user_model->loadAll());
		
		$this->load->view('user/admin/index', $data);
	}

	public function add(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> ', '</p></div>');

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() == FALSE){			
			$this->load->view('user/admin/add');	
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);	
		}
		else {
			$this->user_model->user_email = $this->input->post('email');
			$this->user_model->user_name = $this->input->post('name');
			$this->user_model->user_password = $this->input->post('password');

			$user_id = $this->user_model->save();			
			$this->session->set_flashdata('updated', 'User was created.');
			
			redirect("admin/user/edit/$user_id");
		}		
	}

	public function edit($user_id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> ', '</p></div>');

		// $this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() == FALSE){
			$data = array('user'=> $this->user_model->load($user_id) );
			$this->load->view('user/admin/edit', $data);	
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);	
		}
		else {
			$this->user_model->user_id = $user_id;
			$this->user_model->user_email = $this->input->post('email');
			$this->user_model->user_name = $this->input->post('name');
			$this->user_model->user_password = $this->input->post('password');

			$this->user_model->update();			
			$this->session->set_flashdata('updated', 'User was saved.');
			
			redirect("admin/user/edit/$user_id");
		}
	}
	
	public function del($user_id){		
		$this->user_model->deleteById($user_id);
		
		$data = array('error' => false);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
	}
	
}