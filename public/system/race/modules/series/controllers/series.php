<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Series extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('series_model');
	}
	
	public function index() {		
		$this->load->helper('html');
		
		$series = $this->series_model->loadAll();
		$this->load->view('series/index', array('series'=>$series));
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
	}
	
	public function view($series_url = false){
		$series = $this->series_model->loadByUrl($series_url);
		if(! $series ){
			show_404();
		}
		else {
			$this->load->view('series/view', array('series'=>$series));
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
		}
	}
	
}