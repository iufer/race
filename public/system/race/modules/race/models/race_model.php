<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_model extends CI_model {
	protected $_table = 'race';
	
	public $race_id;
	public $race_url;
	public $race_name;
	public $race_subtitle;
	public $race_description;
	public $race_registration_time;
	public $race_start_time;
	public $race_race_type_id;
	public $race_race_status_id;
	public $race_course_id;
	public $race_will_attend_count;
	public $race_date_created;
	public $race_date_modified;
	public $race_point_bracket;
	public $race_point_bracket_multiplier;
	public $race_laps;
	public $race_sponsor_id;
		
	public function load($id){
		$this->db->from($this->_table);
		$this->db->limit(1);
		$this->db->where('race.race_id', $id);
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$race = $query->row(); 
			$race->is_past = ( mysql_to_unix($race->race_start_time) < time() );
			return $race;
		}
		else {
			return false;
		}
	}
	
	public function loadSet($ids){
		$this->db->from($this->_table);
		$this->db->where_in('race_id', $ids);
		$this->db->order_by('race_start_time');
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$races = $query->result(); 
			foreach($races as $race) {
				$race->is_past = ( mysql_to_unix($race->race_start_time) < time() );
			}
			return $races;
		}
		else {
			return false;
		}
	}
	
	public function loadByUrl($url){
		//$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->where('race.race_url', $url);
		$this->db->where_not_in('race_race_status_id', array(1)); //omit draft races
		$this->db->limit(1);
		
		$this->db->select('*');
		$this->db->join('race_status', 'race.race_race_status_id = race_status.race_status_id');
		$this->db->join('race_type', 'race.race_race_type_id = race_type.race_type_id');
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		// $this->db->join('sponsor', 'race.race_sponsor_id = sponsor.sponsor_id', 'left');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$race = $query->row();
		
			$this->load->model('result/result_model');
			$race->has_results = $this->result_model->countForRaceId($race->race_id);		
			$race->is_past = ( mysql_to_unix($race->race_start_time) < time() );
		
			return $race;
		}
		else {
			return false;
		}
	}
	
	public function loadAllFuture($public = false, $race_type_id = false){
		if($race_type_id > 0) $this->db->where('race_race_type_id', $race_type_id);
		if($public) $this->db->where('race_race_status_id', 2);
			
		$this->db->where('race_start_time >', date( 'Y-m-d H:i:s'));
		$future = $this->loadAll();
		return ($future) ? $future : array();	
	}
	
	public function loadAllPast($public = false){
		if($public) $this->db->where('race_race_status_id', 2);

		$this->db->select('*, count(result.result_id) as result_count');
		$this->db->join('result', 'race.race_id = result.result_race_id','left');
		$this->db->where('race_start_time <', date( 'Y-m-d H:i:s'));
		$this->db->order_by('race_start_time','desc');
		$this->db->group_by('race_id');
		
		$past = $this->loadAll();
		return ($past) ? $past : array();	
	}
	
	public function loadAllPastInRangeByType($public, $from, $span, $race_type_id) {
		if($from !== false and $span !== false){
			$this->db->limit($span, $from);
		}
		if($race_type_id > 0) $this->db->where('race_race_type_id', $race_type_id);
		return $this->loadAllPast($public);
	}
	
	public function loadAllThisMonth($month = 0){
		$this->db->where('race_race_status_id', 2);
		if($month == 0) {
			$startdate = mktime(0, 0, 0, date('m'), 1, date('Y'));
			$enddate = mktime(23, 59, 59, date('m')+1, 0, date('Y'));
			
			$this->db->where('race_start_time >', date( 'Y-m-d H:i:s', $startdate ));			
			$this->db->where('race_start_time <', date( 'Y-m-d H:i:s', $enddate ));
		}
		else {
			$startdate = mktime(0, 0, 0, date('m')+$month, 1, date('Y'));
			$enddate = mktime(23, 59, 59, date('m')+$month+1, 0, date('Y'));
			
			$this->db->where('race_start_time >', date( 'Y-m-d H:i:s', $startdate ));			
			$this->db->where('race_start_time <', date( 'Y-m-d H:i:s', $enddate ));
		}
		$future = $this->loadAll();
		return ($future) ? $future : array();		
	}
	
	public function loadAll($order = false){
		switch($order){
			case 'created_desc':
				$this->db->order_by('race_date_created', 'desc');
				break;
			case 'created_asc':
				$this->db->order_by('race_date_created', 'desc');
				break;
			case false:
			default:
				$this->db->order_by('race_start_time');
				break;
		}
	
		$this->db->join('race_status', 'race.race_race_status_id = race_status.race_status_id');
		$this->db->join('race_type', 'race.race_race_type_id = race_type.race_type_id');
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		
		$query = $this->db->get($this->_table);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	public function loadAllByCourseId($course_id, $public = false){
		if($public)
			$this->db->where('race_race_status_id', 2);
					
		$this->db->order_by('race_start_time','desc');		
		$this->db->where('race_course_id', $course_id);
		return $this->loadAll();
	}
	
	public function listAll(){
		$this->load->helper('date');
		$results = $this->loadAll();
		$races = array();
		foreach($results as $race){
			$races[ $race->race_id ] = $race->race_name .' ('. date("F j, g:i a", mysql_to_unix($race->race_start_time)) .')';
		}
		return $races;
	}	
	public function listAllUpcoming(){
		$this->db->where('race_start_time <', date( 'Y-m-d H:i:s'));
		$this->db->where('race_race_status_id', '2');
		$this->db->order_by('race_start_time','desc');
		return $this->listAll();
	}	
	
	public function save(){
		$this->race_url = url_title($this->race_name .'-'. date("Y-m-d", mysql_to_unix($this->race_start_time) ), 'dash', true);
		$this->race_date_created = now();
		$this->race_date_modified = $this->race_date_created;
		$this->race_will_attend_count = 0;
		
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		$race = $this;
		
		// unset things we dont want to update
		unset($race->race_url);		
		unset($race->race_date_created);
		unset($race->race_will_attend_count);
		
		$race->race_date_modified = now();
		$this->db->where('race_id', $race->race_id);	
		$this->db->update($this->_table, $race);
		return $this->race_id;
	}
	
	public function deleteById($race_id){
		$this->db->delete($this->_table, array('race_id' => $race_id));
	}
	
	public function setStartDateTime($date, $start_time){
		$this->race_start_time = $this->_setDate($date, $start_time);
	}
	
	public function setRegistrationDateTime($date, $registration_time = false){
		// parse the date and time
		if(!$registration_time) {
			$this->race_registration_time = $this->race_start_time;
		}
		else {
			$this->race_registration_time = $this->_setDate($date, $registration_time);
		}
	}	
	
	private function _setDate($date, $time){
		$this->load->helper('date');
		$date_time = $date .' '. $time;
		return date( 'Y-m-d H:i:s', human_to_unix($date_time) );		
	}
	
	public function loadUpcoming($limit = 10, $window = false) {
		if($window !== false){
			$end  = mktime(date('H'), date('i'), date('s'), date("m") , date("d") + $window, date("Y"));			
			$this->db->where('race_start_time <', date( 'Y-m-d H:i:s', $end ));
		}
		$this->db->where('race_start_time >', now());
		$this->db->where('race_race_status_id', '2');
		$this->db->order_by('race_start_time');
		
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		$this->db->join('race_type','race.race_race_type_id = race_type.race_type_id');
		
		$this->db->limit($limit);
		$this->db->from($this->_table);  
		$query = $this->db->get();
		return $query->result();
	}

	public function incrementWillAttend($race_id) {
		$race = $this->load($race_id);
		$race->race_will_attend_count++;
		
		$data = array('race_date_modified' => now(),
		 			  'race_will_attend_count' => $race->race_will_attend_count
					 );
		$this->db->update($this->_table, $data, array('race_id'=>$race_id));
		
		return $race->race_will_attend_count;
	}

	public function updateStatusByRaceId($race_status_id, $race_id){
		$this->db->update($this->_table, array('race_race_status_id'=>$race_status_id), array('race_id' => $race_id));
	}

	public function loadBySearch($string){
		$this->db->like('race_name', $string);
		$this->db->or_like('race_description', $string);
		$this->db->or_like('race_subtitle', $string);
		$this->db->where('race_race_status_id', '2');
		$this->db->from($this->_table);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();		
		else return array();
	}
	
	public function setCourseIdNull($course_id) {
		$this->db->where('race_course_id', $course_id);
		$this->db->from($this->_table);
		$query = $this->db->get();
		$races =  $query->result();		

		foreach($races as $race){
			$this->db->update($this->_table, array('race_course_id'=>null), array('race_id' => $race->race_id));
		}
	}
	public function setSponsorIdNull($sponsor_id) {
		$this->db->where('race_sponsor_id', $sponsor_id);
		$this->db->from($this->_table);
		$query = $this->db->get();
		$races =  $query->result();		

		foreach($races as $race){
			$this->db->update($this->_table, array('race_sponsor_id'=>0), array('race_id' => $race->race_id));
		}
	}

	public function countPastRaces($public = true){
		if($public) $this->db->where('race_race_status_id', 2);
		$this->db->where('race_start_time <', date( 'Y-m-d H:i:s'));
		return $this->db->count_all_results($this->_table);
	}
	
	public function countAllPastInType($public = true, $race_type_id){
		if($public) $this->db->where('race_race_status_id', 2);
		$this->db->where('race_race_type_id', $race_type_id);
		$this->db->where('race_start_time <', date( 'Y-m-d H:i:s'));
		return $this->db->count_all_results($this->_table);
	}
}