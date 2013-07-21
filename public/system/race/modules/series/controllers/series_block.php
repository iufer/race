<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Series_block extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('series_model');
	}
	
	public function upcoming($limit = 20){
		$data = array('series' => $this->series_model->loadUpcoming($limit));			
		return $this->load->view('series/block/upcoming', $data, true);
	}
	
	public function race($race_id = false){
		$this->load->model('series_race/series_race_model');
		if($race_id){
			$series = $this->series_race_model->seriesByRaceId($race_id);
			if(count($series) > 0){
				return $this->load->view('series/block/race', array('series'=>$series), true);
			}
			else {
				return "Not a part of a series";
			}
		}
	}
}