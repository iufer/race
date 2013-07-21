<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('result_model');
	}
	
	// public function update(){
	// 	$this->result_model->convertAll();
	// }
}