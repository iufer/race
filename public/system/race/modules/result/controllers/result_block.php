<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_block extends RA_Controller {

	private $cache = array();

	public function __construct(){
		parent::__construct();
		$this->load->model('result_model');
	}
	
	/**
	 * A block that lists the last 5 races with data posted
	 *
	 * @param string $limit 
	 * @return void
	 * @author cgiufer
	 */
	public function recent($limit = 5){
		$data = array('results'=>$this->result_model->loadRecent($limit));
		if(count($data['results']) > 0)			
			return $this->load->view('result/block/recent', $data, true);
		else
			return "No recent results posted";
	}
	
	public function race($race_id){
		$this->load->helper('result');
		$this->load->model('rider_category/rider_category_model');
		$this->load->model('user/user_model');
		
		$data = array();
		$data['rider_categories'] = $this->rider_category_model->loadAll();
		$data['results'] = $this->result_model->sortResultsByCategory( $this->result_model->loadByRaceId( $race_id) );
		$data['admin'] = (($this->user_model->isLoggedIn() and $this->uri->segment(1) == 'admin'));
		return $this->load->view('result/block/race', $data, true);
	}
	
	public function race_admin($race_id){
		$this->load->helper('result');
		$this->load->model('rider_category/rider_category_model');
		
		$data = array();
		$data['rider_categories'] = $this->rider_category_model->loadAll();
		$data['results'] = $this->result_model->sortResultsByCategory( $this->result_model->loadByRaceId( $race_id) );
		return $this->load->view('result/block/race_admin', $data, true);
	}
	
	public function series($series_id){
		//error_reporting(-1);
		$this->load->model('rider_category/rider_category_model');
		
		$results = $this->result_model->loadBySeriesId($series_id);
		$rider_categories = $this->rider_category_model->loadAll();
		
		return $this->load->view('result/block/series', array('results'=>$results, 'rider_categories'=>$rider_categories), true);
	}	
	
	// This Rider Results block is sensitive to pagination
	public function rider($rider_id, $admin = false, $base_url = null, $pagination_from = 0){
		$this->load->helper('result');		
		$this->load->model('user/user_model');		
		$this->load->library('pagination');

		// pagination size
		$span = 10;

		$data = array();
		$data['results'] = $this->result_model->sortResultsByRace($this->result_model->loadByRiderIdInRange($rider_id, $pagination_from, $span));			



		$this->pagination->initialize( 
			array(
				'base_url'=> site_url($base_url),
				'total_rows'=> $this->result_model->countRacesByRiderId($rider_id),
				'per_page'=> $span,
				'uri_segment'=> 4,
				'num_links'=> 10,
				'full_tag_open' => '<div class="pagination"><ul>',
				'full_tag_close' => '</ul></div>',
				'first_link' => 'First',
				'first_tag_open' => '<li>',
				'first_tag_close' => '</li>',								
				'last_link' => 'Last',
				'last_tag_open' => '<li>',
				'last_tag_close' => '</li>',
				'next_link' => 'Next',
				'next_tag_open' => '<li>',
				'next_tag_close' => '</li>',								
				'prev_link' => 'Previous',
				'prev_tag_open' => '<li>',
				'prev_tag_close' => '</li>',
				'cur_tag_open' => '<li class="active"><a>',
				'cur_tag_close' => '</a></li>',
				'num_tag_open' => '<li>',
				'num_tag_close' => '</li>'
			)
		);
		$data['from'] = $pagination_from;
		$data['span'] = $span;
		$data['pagination_links'] = $this->pagination->create_links();
		// admin view?
		$data['admin'] = ($admin || ($this->user_model->isLoggedIn() and $this->uri->segment(1) == 'admin'));

		return $this->load->view('result/block/rider', $data, true);
	}
	
	public function rider_admin($race_id){
		echo $this->rider($race_id, true);
	}	
	
	public function riderLastRace($rider_id){
		$data = array();
		if(isset($this->cache[$rider_id])){
			$results = $this->cache[$rider_id];
		}
		else {
			$results = $this->cache[$rider_id] = $this->result_model->sortResultsByRace($this->result_model->loadByRiderId($rider_id));			
		}
		
		$race = reset($results);
		echo anchor("race/{$race[0]->race_url}", $race[0]->race_name);
	}
	
	public function riderFirstRace($rider_id){
		$data = array();
		if(isset($this->cache[$rider_id])){
			$results = $this->cache[$rider_id];
		}
		else {
			$results = $this->cache[$rider_id] = $this->result_model->sortResultsByRace($this->result_model->loadByRiderId($rider_id));			
		}
		$race = end($results);
		echo anchor("race/{$race[0]->race_url}", $race[0]->race_name);
	}
	
	public function add($race_id, $race = false) {
		$this->load->helper('form');
		
		$this->load->model('result_type/result_type_model');
		$this->load->model('rider_category/rider_category_model');

		$data = array();
		if($race){
			$data['race'] = $race;
		}
		else {
			$this->load->model('race/race_model');			
			$data['race'] = $this->race_model->load($race_id);
		}
		$data['result_types'] = $this->result_type_model->listAll();		
		$data['rider_categories'] = $this->rider_category_model->listAll();
				
		return $this->load->view('result/block/add', $data, true);
			
	}
	
	public function podium($rider_id){
		$results = $this->result_model->countPlacesByRiderId($rider_id);
		$data = array('results' => array());
		foreach($results as $result){
			$data['results'][ $result->result_data ] = $result->result_count;
		}
		return $this->load->view('result/block/podium', $data, true);
	}
	
	public function course($course_id, $limit = 5){
		$results = $this->result_model->fastestTimeByCourseId($course_id, $limit);
		return $this->load->view('result/block/course', array('results'=>$results), true);
	}
	
	public function riderLatest($rider_id, $rider_name = '') {
		if(isset($this->cache[$rider_id])){
			$results = $this->cache[$rider_id];
		}
		else {
			$results = $this->cache[$rider_id] = $this->result_model->sortResultsByRace($this->result_model->loadByRiderId($rider_id));			
		}
		
		$race = reset($results);
		return $this->load->view('result/block/rider_latest', array('race'=>$race, 'rider_name'=>$rider_name), true);
	}

	public function riderRaceTypes($rider_id){
		$results = $this->result_model->raceTypesByRiderId($rider_id);
		return $this->load->view('result/block/rider_race_types', array('race_types'=>$results), true);
	}
	
	public function riderTotalMiles($rider_id){
		$miles = $this->result_model->countMilesByRiderId($rider_id);
		return $this->load->view('result/block/rider_total_miles', array('miles'=>$miles), true);
	}
}