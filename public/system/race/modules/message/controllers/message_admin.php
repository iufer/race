<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_admin extends RA_Controller {

	public $loginRequired = true;	

	public function __construct(){
		parent::__construct();
		$this->load->model('message/message_model');
	}
	
	public function index(){
		$messages = $this->message_model->loadAll();
		$this->load->view('message/admin/index', array('messages'=>$messages));
	}
		
	public function add(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> ', '</p></div>');

		if($this->form_validation->run('admin/message/add') == FALSE){			
			$this->load->view('message/admin/add');			
		}
		else {
			$this->load->model('user/user_model');
			$this->message_model->message_user_id = $this->user_model->id();		
			$this->message_model->message_date_expires = $this->input->post('date_expires').' '.$this->input->post('time_expires');
			$this->message_model->message_title   = $this->input->post('title');
			$this->message_model->message_message = $this->input->post('message');
		
			$message_id = $this->message_model->save();
		
			$this->session->set_flashdata('updated', 'Message was saved.');
		
			redirect("admin/message/edit/$message_id");
		}
	}
	
	public function edit($message_id){		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> ', '</p></div>');

		if($this->form_validation->run('admin/message/add') == FALSE){
			$message = $this->message_model->load($message_id);
			$this->load->view('message/admin/edit', array('message'=>$message));		
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);	
		}
		else {
			$this->load->model('user/user_model');
			
			$this->message_model->message_id = $message_id;
			$this->message_model->message_user_id = $this->user_model->id();			
			$this->message_model->message_date_expires = $this->input->post('date_expires') .' '. $this->input->post('time_expires');
			$this->message_model->message_title   = $this->input->post('title');
			$this->message_model->message_message = $this->input->post('message');		
			$this->message_model->update();
		
			$this->session->set_flashdata('updated', 'Message was saved.');
		
			redirect("admin/message/edit/$message_id");
		}
	}
	
	public function expire($message_id){
		$this->message_model->expireById($message_id);
		$data = array('error'=>false);
		echo_json($data);
	}
}