<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rider_category_block extends RA_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('rider_category_model');
	}

	public function listing($base_uri = '') {
		$rider_categories = $this->rider_category_model->loadAll();
		return $this->load->view('rider_category/block/listing', array('rider_categories'=>$rider_categories, 'base_uri'=>$base_uri), true);
	}

}