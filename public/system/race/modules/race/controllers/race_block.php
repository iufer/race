<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_block extends RA_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('race_model');
		$this->load->config('race_config');
	}
	
	public function upcoming($limit = 20){
		$window = $this->config->item('race_block_upcoming_window_days');
		$upcoming = $this->race_model->loadUpcoming($limit, $window);
		
		return $this->load->view('race/block/upcoming', array('upcoming'=>$upcoming), true);		
	}
	
	public function next(){
		$next = $this->race_model->loadUpcoming(1);	
		return $this->load->view('race/block/next', array('next'=>$next), true);
	}
	
	public function series($series_id, $series = false, $direction = 'asc'){
		$this->load->model('series_race/series_race_model');
		$races = $this->series_race_model->racesBySeriesId($series_id, true, ($direction === 'asc'));
				
		return $this->load->view('race/block/series', array('races'=>$races), true);
	}
	
	public function course($course_id, $course = false){
		$races = $this->race_model->loadAllByCourseId($course_id, true);
		
		return $this->load->view('race/block/course', array('races'=>$races), true);
	}
	
	public function selector($race_ids=array()){
		$defaults = array();
		if(count($race_ids) > 0){
			$this->load->model('race/race_model');
			$defaults = $this->race_model->loadSet($race_ids);
		}
		$races = $this->race_model->loadAll('created_desc');
		return $this->load->view('race/block/selector', array('races'=>$races, 'defaults'=>$defaults), true);

	}	
	public function calendar(){
		return $this->load->view('race/block/calendar', null, true);
	}
	
	public function comments($race_id){
		return $this->load->view('race/block/comments', array('race_id'=>$race_id), true);
	}
}