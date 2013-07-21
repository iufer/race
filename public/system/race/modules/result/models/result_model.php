<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_model extends CI_model {	
	protected $_table = 'result';
	
	public $result_id;
	public $result_result_type_id;
	public $result_rider_id;
	public $result_race_id;
	public $result_data;
	public $result_data_raw;
	public $result_note;
	public $result_rider_category_id;
	public $result_date_created;
	public $result_date_modified;
	
	// public function map($id) {
	// 	$result = $this->load($id);
	// 	$this->result_id = $result->result_id;
	// 	$this->result_result_type_id = $result->result_result_type_id;
	// 	$this->result_rider_id = $result->result_rider_id;
	// 	$this->result_race_id = $result->result_race_id;
	// 	$this->result_data = $result->result_data;
	// 	$this->result_note = $result->result_note;
	// 	$this->result_rider_category_id = $result->result_rider_category_id;
	// 	$this->result_date_created = $result->result_date_created;
	// 	$this->result_date_modified = $result->result_date_modified;
	// }
	
	public function load($id){
		$query = $this->db->get_where($this->_table, array('result_id'=> $id), 1);
		$result = $query->row();
		
		// save the raw result data pre decode
		$result->result_data_raw = $result->result_data;		
		if($result->result_result_type_id == 2) {
			$result->result_data = $this->decodeResult($result->result_data);
		}
			
		return $result;
	}
	
	public function loadExtended($id) {
		$this->db->join('result_type', 'result.result_result_type_id = result_type.result_type_id');
		$this->db->join('rider_category', 'rider_category.rider_category_id = result.result_rider_category_id');
		$this->db->join('race', 'result.result_race_id = race.race_id');
		$this->db->join('rider', 'result.result_rider_id = rider.rider_id');
		return $this->load($id);
	}	
	
	public function loadAll(){
		$query = $this->db->get($this->_table);
		$results = $query->result();
		foreach($results as $result){
			if($result->result_result_type_id == 2)
				$result->result_data = $this->decodeResult($result->result_data);
		}
		return $results;
	}
	
	public function listAll(){
		$r = $this->loadAll();
		$results = array();
		foreach($r as $result){
			$results[ $result->result_id ] = "id: {$result->result_id}, rider_id: {$result->result_rider_id}, race_id: {result->result_race_id}";
		}
		return $results;
	}	
	
	public function loadByRaceId($race_id) {
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('race', 'result.result_race_id = race.race_id');
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		$this->db->join('rider', 'result.result_rider_id = rider.rider_id');
		$this->db->join('result_type', 'result.result_result_type_id = result_type.result_type_id');
		$this->db->join('rider_category', 'rider_category.rider_category_id = result.result_rider_category_id');
		$this->db->where('result_race_id', $race_id);
		$this->db->order_by('result_type_order');
		$this->db->order_by('result_data');	
		
		$query = $this->db->get();
		$results = $query->result();
		foreach($results as $result){
			// if type is time
			if($result->result_result_type_id == 2) {
				
				// if a course is set
				if(! is_null($result->course_id)){
					$distance = ($result->race_laps > 1) ? $result->course_miles * $result->race_laps : $result->course_miles;
					$result->speed = $distance / ($result->result_data / 60 / 60);
				}
				else {
					$result->speed = false;
				}
				
				$result->result_data_raw = $result->result_data;
				$result->result_data = $this->decodeResult($result->result_data);
			}
		}
		return $results;
	}
	
	// $results_rider_categories = array(
	// 			array(
	// 				'name'=>'A Group',
	// 				'riders'=> array(
	// 					array(
	// 						'name'=>'Rider Name',
	// 						'results'=> array(
	// 							array(--resultobj--)
	// 						)
	// 					),
	// 					array(
	// 						'name'=>'Rider Name',
	// 						'results'=> array(
	// 							array(--resultobj--)
	// 						)
	// 					)
	// 				)
	// 			),
	// 			array(
	// 				'name'=>'B Group',
	// 				'riders'=> array(
	// 					array(
	// 						'name'=>'Rider Name',
	// 						'results'=> array(
	// 							array(--resultobj--)
	// 						)
	// 					),
	// 					array(
	// 						'name'=>'Rider Name',
	// 						'results'=> array(
	// 							array(--resultobj--)
	// 						)
	// 					)
	// 				)
	// 			)					
	// 		);
	
	public function loadByRiderIdInRange($rider_id, $from, $span){
		error_log("from: $from, span: $span", 0);
		// get all the ids of the races for this rider
		$this->db->limit($span, $from);
		$races = $this->listRacesByRiderId($rider_id);
		
		$races_array = array();
		foreach($races as $race){
			$races_array[] = $race->result_race_id;
		}

		$this->db->where_in('result_race_id', $races_array);
		return $this->loadByRiderId($rider_id);
	}
	
	public function loadByRiderId($rider_id){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('race','race.race_id = result.result_race_id');
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		$this->db->join('result_type', 'result.result_result_type_id = result_type.result_type_id');
		$this->db->join('rider_category', 'rider_category.rider_category_id = result.result_rider_category_id');		
		$this->db->where('result_rider_id', $rider_id);
		$this->db->where('race_race_status_id', 2);
		$this->db->order_by('race_start_time', 'desc');
		$this->db->order_by('result_type_order');
		$this->db->order_by('result_data');		
			
		$query = $this->db->get();
		$results = $query->result();
		foreach($results as $result){
			// if type is time
			if($result->result_result_type_id == 2) {
				
				// if a course is set
				if(! is_null($result->course_id)){
					$distance = ($result->race_laps > 1) ? $result->course_miles * $result->race_laps : $result->course_miles;
					$result->speed = $distance / ($result->result_data / 60 / 60);
				}
				else {
					$result->speed = false;
				}
				
				$result->result_data_raw = $result->result_data;
				$result->result_data = $this->decodeResult($result->result_data);
			}
		}
		return $results;		
	}	
	
	
	public function loadBySeriesId($series_id){
		$this->db->select('result_data, race_id, race_point_bracket, race_point_bracket_multiplier, result_rider_id, rider_name, result_type_id, series_id, series_name, result_rider_category_id ');
		$this->db->from($this->_table);
		$this->db->join('race', 'result.result_race_id = race.race_id');
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		$this->db->join('rider', 'result.result_rider_id = rider.rider_id');
		$this->db->join('result_type', 'result.result_result_type_id = result_type.result_type_id');
		$this->db->join('rider_category', 'rider_category.rider_category_id = result.result_rider_category_id');
		
		$this->db->join('series_race', 'series_race.series_race_race_id = race.race_id');
		$this->db->join('series', 'series.series_id = series_race.series_race_series_id');
			
		$this->db->where('series_id', $series_id);
		$this->db->where_in('result_type_id', array(1, 3, 5));
		$this->db->order_by('result_type_order');
		$this->db->order_by('result_data');	

		$query = $this->db->get();
		$r = $query->result();
		$query->free_result();
		
		$results_sorted = $this->sortResultsByCategory( $r );
		
		// do all the point calculations here
	
		return $results_sorted;
	}
	
	public function sortResultsByType($r){
		$resultsSortedByType = array();		
		foreach($r as $result){
			$resultsSortedByType[$result->result_result_type_id][] = $result;
		}		
		return $resultsSortedByType;		
	}
	
	public function sortResultsByRider($r){
		$resultsSortedByRider = array();		
		foreach($r as $result){
			$resultsSortedByRider[$result->result_rider_id][] = $result;
		}		
		return $resultsSortedByRider;		
	}		
	
	public function sortResultsByCategory($r){
		$resultsSortedByCategory = array();		
		foreach($r as $result){
			$resultsSortedByCategory[$result->result_rider_category_id][$result->result_rider_id][] = $result;
		}
		return $resultsSortedByCategory;		
	}	
	
	public function sortResultsByRace($r){
		$resultsSortedByType = array();		
		foreach($r as $result){
			$resultsSortedByType[$result->race_id][] = $result;
		}		
		return $resultsSortedByType;		
	}
	
	public function countForRaceId($race_id){
		$this->db->select('count(*) as numrows');
		$this->db->from($this->_table);
		$this->db->where('result_race_id', $race_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result->numrows;
	}

	public function resultCountByRace(){
		$this->db->select('race_id, count(id) as count');
		$this->db->group_by('race_id','rider_id');
		$this->db->from($this->_table);
		$query = $this->db->get();
		$row = $this->query->row();
		return $row->count;
	}

	public function save(){
		$this->result_date_created = now();
		$this->result_date_modified = $this->result_date_created;
		
		if($this->result_result_type_id == 2) {
			// encode time
			$this->result_data = $this->encodeResult($this->result_data);
		}
		unset($this->result_data_raw);		
		
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		// make a copy
		$result = $this;
		
		// unset the fields we dont' want to update
		unset($result->result_date_created);
		unset($result->result_rider_id);
		unset($result->result_race_id);
		unset($result->result_data_raw);
		
		$result->result_date_modified = now();
		
		if($result->result_result_type_id == 2) {
			// encode time
			$result->result_data = $this->encodeResult($result->result_data);
		}
		
		$this->db->where('result_id', $result->result_id);	
		$this->db->update($this->_table, $result);
		return $result->result_id;
	}
		
	public function loadRecent($limit = 5) {
		$this->db->select('*, count(result_id) as `count`');
		$this->db->order_by('result_date_created', 'desc');
		$this->db->group_by('result_race_id');
		$this->db->join('race', 'race.race_id = result.result_race_id');
		$this->db->limit($limit);
		$this->db->from($this->_table);
		
		$query = $this->db->get();
		$races = $query->result();
		return $races;
	}
	
	public function deleteByRaceId($race_id){
		$this->db->delete($this->_table, array('result_race_id' => $race_id));
	}
	
	public function deleteByRiderId($rider_id){
		$this->db->delete($this->_table, array('result_rider_id' => $rider_id));
	}
	
	public function deleteById($result_id){
		$this->db->delete($this->_table, array('result_id' => $result_id));		
	}
	
	public function countPlacesByRiderId($rider_id){
		$this->db->select('*, count(result_data) as result_count');
		$this->db->group_by('result_data');
		$this->db->where('result_result_type_id', 3);
		$this->db->where('result_rider_id', $rider_id);
		$this->db->order_by('result_data');
		$this->db->from($this->_table);
		
		$query = $this->db->get();
		$results = $query->result();
		return $results;		
	}
	
	private function encodeResult($data){
		return timeToSeconds($data);
	}
	
	private function decodeResult($data){
		return secondsToTime($data);
	}
	
	// the $unique key will only show the fastest result for a rider and omits any further results
	// this prevents a rider from showing up in the list more than once
	public function fastestTimeByCourseId($course_id, $limit = 5, $unique = true){		
		$this->db->select('result_data, rider_id, rider_name, result_result_type_id, result_date_created, race_url, race_laps, course_miles, course_id');
		$this->db->join('race', 'race.race_id = result.result_race_id');
		$this->db->join('course', 'course.course_id = race.race_course_id', 'left');
		$this->db->join('rider', 'rider.rider_id = result.result_rider_id');
		$this->db->join('rider_category', 'rider_category.rider_category_id = result.result_rider_category_id');
		$this->db->where('result_result_type_id', 2);
		$this->db->where('race_course_id', $course_id);
		$this->db->order_by('result_data');
		if($unique === false) $this->db->limit($limit);
		
		$this->db->from($this->_table);
		
		$query = $this->db->get();
		$results = $query->result();
		$riders = array();
		$count = 0;
		$final_results = array();
		
		if($query->num_rows() == 0) {
			return false;
		}
		foreach($results as $result){
			if($count >= $limit) break;
			if($unique){
				// check if userid is already set
				if(isset($riders[$result->rider_id])) continue;				
			}
			// if type is time
			if($result->result_result_type_id == 2) {

				// if a course is set
				if(! is_null($result->course_id)){
					$distance = ($result->race_laps > 1) ? $result->course_miles * $result->race_laps : $result->course_miles;
					$result->speed = $distance / ($result->result_data / 60 / 60);
				}
				else {
					$result->speed = false;
				}
				
				$result->result_data_raw = $result->result_data;
				$result->result_data = $this->decodeResult($result->result_data);
			}
			$riders[$result->rider_id] = 1;
			$count++;
			$final_results[] = $result;
		}		
		
		return $final_results;		
	}
	
	public function swapRiderCategoryId($rider_category_id, $new_rider_category_id){
		$this->db->where('result_rider_category_id', $rider_category_id);
		$data = array('result_rider_category_id'=> $new_rider_category_id);
		$this->db->update($this->_table, $data);
	}
	
	public function raceTypesByRiderId($rider_id) {
		$this->db->select('race_type_description');
		$this->db->select('count(distinct result_race_id) as race_count');
		$this->db->join('rider', 'rider.rider_id = result.result_rider_id');
		$this->db->join('race', 'race.race_id = result.result_race_id');
		$this->db->join('race_type', 'race.race_race_type_id = race_type.race_type_id');
		$this->db->where('rider_id', $rider_id);
		$this->db->group_by('race_type_id');
		$this->db->order_by('race_count','desc');		
		$this->db->from($this->_table);
		
		$query = $this->db->get();
		$results = $query->result();
		
		return $results;
	}
	
	public function getTimesForRace($race_id){
		$this->db->select('*');
		$this->db->from($this->_table);
//		$this->db->join('race', 'result.result_race_id = race.race_id');
		$this->db->join('rider', 'result.result_rider_id = rider.rider_id');
//		$this->db->join('result_type', 'result.result_result_type_id = result_type.result_type_id');
//		$this->db->join('rider_category', 'rider_category.rider_category_id = result.result_rider_category_id');
		$this->db->where('result_race_id', $race_id);
		$this->db->where('result_result_type_id', 2);
		$this->db->order_by('result_rider_category_id');
		$this->db->order_by('result_data');	
		
		$query = $this->db->get();
		$results = $query->result();

		return $results;		
	}
	
	public function dropResultsForRaceOfType($race_id, $result_type_id){
		return $this->db->delete($this->_table, array('result_race_id'=>$race_id, 'result_result_type_id'=>$result_type_id));
	}
	
	public function countMilesByRiderId($rider_id){
		// $this->db->select('course_name, course_miles');
		// $this->db->join('race', 'result.result_race_id = race.race_id');
		// $this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		// $this->db->group_by('race.race_id');
		// $this->db->where('result.result_rider_id', $rider_id);
		// 
		// $this->db->from($this->_table);	
		// $query = $this->db->get();
		// $results = $query->result();

		$query = "select sum(s.course_miles) as miles from (SELECT course_name, course_miles
		FROM (`result`)
		JOIN `race` ON `result`.`result_race_id` = `race`.`race_id`
		LEFT JOIN `course` ON `race`.`race_course_id` = `course`.`course_id`
		WHERE `result`.`result_rider_id` =  $rider_id
		GROUP BY `race`.`race_id`) as s";
		
		$query = $this->db->query($query);
		$data = $query->row();
		return $data;					
	}
	
	public function listRidersByRaceId($race_id){
		$this->db->select('result_rider_id, result_rider_category_id');
		$this->db->where('result_race_id', $race_id);
		$this->db->group_by('result_rider_id');
		$this->db->from($this->_table);
		
		$query = $this->db->get();
		$results = $query->result();

		return $results;
	}

	public function listRacesByRiderId($rider_id){
		$this->db->select('result_race_id');
		$this->db->where('result_rider_id', $rider_id);
		$this->db->order_by('result_date_created', 'desc');
		$this->db->group_by('result_race_id');
		$this->db->from($this->_table);
		
		$query = $this->db->get();
		$results = $query->result();

		return $results;
	}

	public function countRacesByRiderId($rider_id){
		$this->db->select('result_race_id');
		$this->db->where('result_rider_id', $rider_id);
		$this->db->group_by('result_race_id');
		$this->db->from($this->_table);
		
		$query = $this->db->get();
		return $query->num_rows();
	}
}