<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rider_category_model extends CI_model {
	
	protected $_table = 'rider_category';
	
	public $rider_category_id;
	public $rider_category_name;
	public $rider_category_order;
	public $rider_category_date_created;
	public $rider_category_date_modified;
	
	public function load($id){
		$query = $this->db->get_where($this->_table, array('rider_category_id'=> $id), 1);
		return $query->row();
	}
	
	public function loadAll(){
		$this->db->order_by('rider_category_order');
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	
	public function listAll(){
		$results = $this->loadAll();
		$types = array();
		foreach($results as $type){
			$types[ $type->rider_category_id ] = $type->rider_category_name;
		}
		return $types;
	}
	
	public function save(){	
		$this->rider_category_name = ucwords($this->rider_category_name);	
		$this->rider_category_date_created = now();
		$this->rider_category_date_modified = now();
		$this->rider_category_order = $this->db->count_all($this->_table) +1;
		
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		$this->rider_category_date_modified = now();
		unset($this->rider_category_order);
		unset($this->rider_category_date_created);		
		$this->db->where('rider_category_id', $this->rider_category_id);
		
		return $this->db->update($this->_table, $this);
	}

	public function deleteById($rider_category_id){
		$this->db->delete($this->_table, array('rider_category_id' => $rider_category_id));
	}

}