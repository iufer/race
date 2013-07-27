<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_type_block extends RA_Controller {

	private $cache = array();

	public function __construct(){
		parent::__construct();
		$this->load->model('race_type_model');
	}
	
	public function selector($race_type_id = null){
		$this->load->helper('form');
		$data = array(
					'race_types'=> $this->race_type_model->listAll(),
					'race_type_id' => $race_type_id
					);
		return $this->load->view('race_type/block/selector', $data, true);		
	}

	public function listing($base_uri = '', $race_type_id) {
		$race_types = $this->race_type_model->loadAll();
		return $this->load->view('race_type/block/listing', array('race_types'=>$race_types, 'base_uri'=>$base_uri, 'selected_race_type_id'=>$race_type_id), true);
	}

}