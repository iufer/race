<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_type_model extends CI_model {
	
	protected $_table = 'race_type';
	
	public $race_type_id;
	public $race_type_type;
	public $race_type_description;
	public $race_type_order;
	public $race_type_default_result_type_id;
	public $race_type_date_created;
	public $race_type_date_modified;
	
	public function load($id){
		$query = $this->db->get_where($this->_table, array('race_type_id'=> $id), 1);
		return $query->row();
	}
	
	public function loadAll(){
		$this->db->order_by('race_type_order');
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	
	public function listAll(){
		$results = $this->loadAll();
		$types = array();
		foreach($results as $type){
			$types[ $type->race_type_id ] = $type->race_type_description;
		}
		return $types;
	}
	
	public function setOrderById($race_type_order = false, $race_type_id = false){
		if($race_type_order !== false and $race_type_id !== false) {
			$this->db->where('race_type_id', $race_type_id);
			$this->db->update($this->_table, array('race_type_order' => $race_type_order));
		}
	}
	
	public function update(){
		$data = array(
			'race_type_description' => $this->race_type_description,
			'race_type_date_modified' => now()
			);
		
		$this->db->update($this->_table, $data, array('race_type_id'=> $this->race_type_id));
	}
}