<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Series_model extends CI_model {	
	protected $_table = 'series';

	public $series_id;
	public $series_name;
	public $series_url;
	public $series_subtitle;
	public $series_description;
	public $series_date_start;
	public $series_date_end;
	public $series_date_created;
	public $series_date_modified;

	public function load($series_id){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->limit(1);
		$this->db->where('series_id', $series_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$series = $query->row(); 		
			return $series;
		}
		else return false;
	}
		
	public function loadAll(){
		$this->db->order_by('series_date_start','desc');
		$query = $this->db->get($this->_table);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else return false;
	}
	
	public function loadByUrl($series_url){
		$query = $this->db->get_where($this->_table, array('series_url'=> $series_url), 1);
		if ($query->num_rows() > 0) {
			$series = $query->row();				
			return $series;
		}
		else return false;
	}
		
	public function loadUpcoming($limit = 10) {
		$this->db->where('series_date_end >', now());
		$this->db->order_by('series_date_start');
				
		$this->db->limit($limit);
		$this->db->from($this->_table);  
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else return false;
	}

	public function loadBySearch($string){
		$this->db->like('series_name', $string);
		$this->db->or_like('series_description', $string);
		$this->db->or_like('series_subtitle', $string);
		$this->db->from($this->_table);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();		
		}
		else return array();
	}

	
	public function save(){		
		$this->series_date_created = now();
		$this->series_date_modified = $this->series_date_created;
		
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		$series = $this;
		
		unset($series->series_date_created);
		unset($series->series_url);
		
		$series->series_date_modified = now();
		$this->db->where('series_id', $series->series_id);	
		$this->db->update($this->_table, $series);
		return true;
	}	
	
	
	public function deleteById($series_id){
		$this->db->delete($this->_table, array('series_id' => $series_id));
	}			
}