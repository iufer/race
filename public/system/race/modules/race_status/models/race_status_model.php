<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_status_model extends CI_model {
	
	protected $_table = 'race_status';
	
	public $race_status_id;
	public $race_status_name;
	public $race_status_order;
	
	public function load($id){
		$query = $this->db->get_where($this->_table, array('race_status_id'=> $id), 1);
		return $query->row();
	}
	
	public function loadAll(){
		$this->db->order_by('race_status_order');
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	
	public function listAll(){
		$results = $this->loadAll();
		$statuses = array();
		foreach($results as $status){
			$statuses[ $status->race_status_id ] = $status->race_status_name;
		}
		return $statuses;
	}	
	
}