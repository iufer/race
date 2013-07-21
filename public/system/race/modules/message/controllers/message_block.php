<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_block extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('message_model');
	}
	
	public function latest($race_id = false){
		if($race_id)
			$message = $this->message_model->latestByRaceId($race_id);
		else
			$message = $this->message_model->latest();
		
		if($message) 
			return $this->load->view('message/block/latest', array('message'=>$message), true);
	}
}