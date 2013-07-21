<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_status_block extends MX_Controller {

	private $cache = array();

	public function __construct(){
		parent::__construct();
		$this->load->model('race_status_model');
	}
	
	public function selector($race_status_id = 2){
		$this->load->helper('form');
		$data = array(
					'race_statuses'=> $this->race_status_model->loadAll(),
					'race_status_id' => $race_status_id
					);
		return $this->load->view('race_status/block/selector', $data, true);
	}
}