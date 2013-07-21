<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Series_race_model extends CI_model {	
	protected $_table = 'series_race';

	public $series_race_id;
	public $series_race_race_id;
	public $series_race_series_id;
	public $series_race_order;
	public $series_race_date_created;
	
	public function loadAll(){
		$query = $this->db->get($this->_table);
		return $query->result();		
	}

	public function racesBySeriesId($series_id, $public = false, $asc = true){
		if($public)
			$this->db->where('race_race_status_id', 2);

		if($asc)
			$this->db->order_by('race_start_time', 'asc');
		else
			$this->db->order_by('race_start_time', 'desc');

		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('race', 'series_race.series_race_race_id = race.race_id');
		$this->db->join('course', 'race.race_course_id = course.course_id', 'left');
		
		$this->db->where('series_race_series_id', $series_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		else return array();
	}

	public function seriesByRaceId($race_id){
					
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('series', 'series_race.series_race_series_id = series.series_id');
		
		$this->db->where('series_race_race_id', $race_id);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function listBySeriesId($series_id){
		$races = $this->racesBySeriesId($series_id);
		$data = array();
		foreach($races as $race){
			$data[] = $race->race_id;
		}
		return $data;
	}
	
	public function bindToSeries($series_id, $races, $atomic = false) {	
		if($atomic){
			$this->deleteBySeriesId($series_id);
		}	
		$this->series_race_series_id = $series_id;
		$this->series_race_date_created = now();
		
		foreach($races as $i=>$race_id){
			$this->series_race_order = $i;
			$this->series_race_race_id = $race_id;
			$this->db->insert($this->_table, $this);
		}		
	}
	
	public function deleteByRaceId($race_id){
		$this->db->delete($this->_table, array('series_race_race_id' => $race_id));
	}
	
	public function deleteBySeriesId($series_id){
		$this->db->delete($this->_table, array('series_race_series_id' => $series_id));
	}
		
}