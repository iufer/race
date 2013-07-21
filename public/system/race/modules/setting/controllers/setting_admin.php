<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_admin extends RA_Controller {

	public $loginRequired = true;	
	
	public function index(){
		$settings = $this->setting_model->loadAll();
		
		$this->load->model('race_type/race_type_model');
		$race_types = $this->race_type_model->loadAll();
		
		$this->load->model('rider_category/rider_category_model');
		$rider_categories = $this->rider_category_model->loadAll();
		
		$this->load->view('setting/admin/index', array('settings'=>$settings, 'race_types'=>$race_types, 'rider_categories'=>$rider_categories));
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);		
	}

}