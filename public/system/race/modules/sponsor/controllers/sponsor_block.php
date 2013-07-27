<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sponsor_block extends RA_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('sponsor_model');
	}
	
	public function listing(){		
		$sponsors = $this->sponsor_model->loadAll();
		return $this->load->view('sponsor/block/list', array('sponsors'=>$sponsors), true);
	}
	
	public function footer(){
		$sponsors = $this->sponsor_model->loadAll();
		return $this->load->view('sponsor/block/footer', array('sponsors'=>$sponsors), true);		
	}
	
	public function selector($default = false){		
		$this->load->helper('form');
		$sponsors = $this->sponsor_model->listAll();
		return $this->load->view('sponsor/block/selector', array('sponsors'=>$sponsors, 'default'=>$default), true);		
	}
	
	public function view($sponsor_id){
		$sponsor = $this->sponsor_model->load($sponsor_id);
		return $this->load->view('sponsor/block/view', array('sponsor'=>$sponsor), true);				
	}
}