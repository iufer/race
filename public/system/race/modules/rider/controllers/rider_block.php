<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rider_block extends RA_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('rider_model');
	}
	
	public function newRiders($limit = 5){
		$data = array('riders' => $this->rider_model->getNewestRiders($limit));
		if(count($data['riders']) > 0)
			return $this->load->view('rider/block/new', $data, true);		
		else
			return "No new riders";
	}
	
}