<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sponsor_model extends CI_model {
	
	protected $_table = 'sponsor';
	protected $_cache = array();
	
	public $sponsor_id;
	public $sponsor_name;
	public $sponsor_link;
	public $sponsor_description;
	public $sponsor_order;
	public $sponsor_image_id;
	public $sponsor_date_created;
	public $sponsor_date_modified;
	
	public function load($sponsor_id){
		$this->db->join('image', 'image.image_id = sponsor.sponsor_image_id', 'left');
		$query = $this->db->get_where($this->_table, array('sponsor_id'=> $sponsor_id), 1);
		return $query->row();
	}
	
	public function loadAll(){
		if(isset($this->_cache['loadAll'])){
			return $this->_cache['loadAll'];
		}
		$this->db->join('image', 'image.image_id = sponsor.sponsor_image_id', 'left');		
		$this->db->order_by('sponsor_order');
		$query = $this->db->get($this->_table);
		$result = $this->_cache['loadAll'] = $query->result();
		return $result;
	}
	
	public function listAll(){
		$results = $this->loadAll();

		$sponsors = array('0'=>'None');
		foreach($results as $s){
			$sponsors[ $s->sponsor_id ] = $s->sponsor_name;
		}
		return $sponsors;
	}
	
	public function save(){		
		$this->sponsor_date_created = now();
		//$this->sponsor_date_modified = $this->sponsor_date_created;
				
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		$sponsor = $this;
		
		// if there was not a new image uploaded then dont update the image id
		if($sponsor->sponsor_image_id === false){
			unset($sponsor->sponsor_image_id);
		}
		unset($sponsor->sponsor_date_created);
		unset($sponsor->sponsor_order);		
				
		$sponsor->sponsor_date_modified = now();
		$this->db->where('sponsor_id', $sponsor->sponsor_id);	
		$this->db->update($this->_table, $sponsor);
		return $this->sponsor_id;
	}	

	public function deleteById($sponsor_id){
		$this->db->delete($this->_table, array('sponsor_id'=>$sponsor_id));
	}
}