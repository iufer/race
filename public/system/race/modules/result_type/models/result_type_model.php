<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_type_model extends CI_model {
	
	protected $_table = 'result_type';
	
	public $result_type_id;
	public $result_type_name;
	public $result_type_order;
	
	public function load($id){
		$query = $this->db->get_where($this->_table, array('result_type_id'=> $id), 1);
		return $query->row();
	}
	
	public function loadAll(){
		$this->db->order_by('result_type_order');
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	
	public function listAll(){
		$results = $this->loadAll();
		$types = array();
		foreach($results as $type){
			$types[ $type->result_type_id ] = $type->result_type_name;
		}
		return $types;
	}
	
}