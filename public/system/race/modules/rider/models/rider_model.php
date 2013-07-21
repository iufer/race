<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rider_model extends CI_model {	
	protected $_table = 'rider';

	public $rider_id;
	public $rider_name;
	public $rider_public;
	public $rider_profile_views;
	public $rider_date_created;
	public $rider_date_modified;
	public $rider_rider_category_id;
	
	private $_doPostProcessing = true;
	
	public function setDoPostProcessing($s){
		$this->_doPostProcessing = $s;
	}
	
	public function listBySearch($term) {
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->like('rider_name', $term);
		$query = $this->db->get();
		$result = $query->result();
		$riders = array();
		foreach($result as $rider){
			$riders[] = array('value'=> $rider->rider_id, 'label'=>$rider->rider_name, 'rider_category_id'=>$rider->rider_rider_category_id);
		}
		return $riders;
	}
	
	public function save(){	
		$this->rider_name = ucwords($this->rider_name);	
		$this->rider_date_created = now();
		$this->rider_date_modified = now();
		$this->rider_public = 1;
		$this->rider_profile_views = 0;
		
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function deleteById($rider_id) {
		return $this->db->delete($this->_table, array('rider_id'=>$rider_id));
	}
	
	/**
	 * update
	 *
	 * @param object $rider 
	 * @return bool success
	 * @author chris
	 */
	public function update($rider = false){
		$rider = ($rider) ? $rider : $this;
		
		//do not overwrite
		unset($rider->rider_date_created);
		unset($rider->rider_profile_views);
		
		$rider->rider_date_modified = now();
		$this->db->where('rider_id', $rider->rider_id);
		$this->db->update($this->_table, $rider);		
		return true;
	}	
	
	public function modified($rider_id) {	
		$this->db->where('rider_id', $rider->rider_id);
		$this->db->update($this->_table, array('rider_date_modified'=> now()));		
		return true;
	}
	
	public function get($id){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->where('rider_id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();	
		}
		else return false;
	}
	
	public function load($id, $post_processing = true){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('rider_category', 'rider.rider_rider_category_id = rider_category.rider_category_id');		
		$this->db->where('rider_id', $id);
		
		// join the results to get the toal race count
		$this->db->select('count(distinct result_race_id) as race_count');
		$this->db->join('result', 'result.result_rider_id = rider.rider_id', 'left');
		$this->db->group_by('result.result_rider_id');
		
		// join the results to their races so we can only count the ones with status == active
		$this->db->join('race', 'result.result_race_id = race.race_id', 'left');
		$this->db->where('race_race_status_id', 2);

		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			$rider = $query->row();
			if($this->_doPostProcessing) $rider = $this->prepareForPublic($rider);
			return $rider;
		}
		else {
			return false;
		}
	}
	
	public function loadAll($from = false, $span = false, $post_processing = true){
		$this->db->select('*');
		$this->db->from($this->_table);
		if($from !== false and $span !== false){
			$this->db->limit($span, $from);
		}
		$this->db->join('rider_category', 'rider.rider_rider_category_id = rider_category.rider_category_id');

		// join the results to get the toal race count
		$this->db->select('count(distinct result_race_id) as race_count');	
		$this->db->join('result', 'result.result_rider_id = rider.rider_id');
		$this->db->group_by('result.result_rider_id');
		
		// join the results to their races so we can only count the ones with status == active
		$this->db->join('race', 'result.result_race_id = race.race_id');
		$this->db->where('race_race_status_id', 2);
		
		// $this->db->order_by('rider_date_modified', 'desc');
		$this->db->order_by('rider_name', 'asc');
						
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$riders = $query->result();

			if($this->_doPostProcessing) $riders = $this->prepareForPublic($riders);
			return $riders;
		}
		else {
			return false;
		}
	}
	
	public function loadAllInRangeInCategory($from = false, $span = false, $rider_category_id = 0, $post_processing = true) {
		if($rider_category_id > 0) $this->db->where('rider_rider_category_id', $rider_category_id);
		return $this->loadAll($from, $span, $post_processing);
	}
	
	public function loadAllInOrder(){
		$this->db->order_by('rider_id');
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('rider_category', 'rider.rider_rider_category_id = rider_category.rider_category_id');
		
		$this->db->order_by('rider_id');
				
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$riders = $query->result();
			return $riders;
		}
		else {
			return false;
		}
	}
	
	public function countAll(){
		return $this->db->count_all($this->_table);
	}
	
	public function countAllInCategory($rider_category_id){
		$this->db->where('rider_rider_category_id', $rider_category_id);
		return $this->db->count_all_results($this->_table);
	}
	
	public function getNewestRiders($limit = 20){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->order_by('rider_date_created','desc');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		$riders = $query->result();
		$riders = $this->prepareForPublic($riders);
		return $riders;
	}
	
	private function prepareForPublic($riders){
		if(is_array($riders)){
			foreach($riders as $rider){
				if($rider->rider_public == 0){
					$rider->rider_name = setting('rider_anon_name');
				}
			}
		}
		else {
			if($riders->rider_public == 0){
				$riders->rider_name = setting('rider_anon_name');
			}
		}
		return $riders;
	}

	public function loadBySearch($term) {
		$this->db->from($this->_table);
		$this->db->like('rider_name', $term);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else return array();
	}
	
	
	public function profileView($rider_id){
		// iterate the profile view record
		$this->db->set('rider_profile_views', 'rider_profile_views +1', false);
		$this->db->where('rider_id', $rider_id);
		$this->db->update($this->_table);
	}
	
	/**
	 * Get a rider_id if a rider exists with the name supplied
	 *
	 * @param string $rider_name 
	 * @return int $rider_id or bool on fail
	 * @author cgiufer
	 */
	public function riderExistsByName($rider_name){
		$this->db->where('rider_name', $rider_name);
		$this->db->from($this->_table);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$rider = $query->row();
			return $rider->rider_id;
		}
		else {
			return false;
		}
	}

	public function swapRiderCategoryId($rider_category_id, $new_rider_category_id){
		$this->db->where('rider_rider_category_id', $rider_category_id);
		$data = array('rider_rider_category_id'=> $new_rider_category_id);
		$this->db->update($this->_table, $data);
	}
		

}