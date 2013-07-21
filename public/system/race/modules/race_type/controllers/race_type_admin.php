<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_type_admin extends RA_Controller {

	public $loginRequired = true;	

	public function __construct(){
		parent::__construct();
		$this->load->model('race_type/race_type_model');
	}
	
	public function reorder(){
		$order = $this->input->get('racetypeid');
		if($order === false){
			$data = array('error' => 'No order array supplied');
		}
		else {
			foreach($order as $race_type_order => $race_type_id){
				$this->race_type_model->setOrderById($race_type_order +1, $race_type_id);
			}
		
			$data = array('error' => false);
		}
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
		
	}
	
	public function save($race_type_id = false){
		if($race_type_id === false) {
			$data = array('error' => 'No ID supplied');
		}
		else {		
			$race_type_description = $this->input->get('race_type_description');
		
			$this->race_type_model->race_type_id = $race_type_id;
			$this->race_type_model->race_type_description = $race_type_description;
			$error = $this->race_type_model->update();
		
			$data = array('error' => $error);
		}
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
		
	}
}