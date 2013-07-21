<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_model extends CI_model {	
	protected $_table = 'course';
	
	public $course_id;
	public $course_name;
	public $course_url;
	public $course_description;
	public $course_miles;
	public $course_elevation;
	public $course_category_climb;
	public $course_date_created;
	public $course_date_modified;
	public $course_kml;
	
	public function load($id){
		$query = $this->db->get_where($this->_table, array('course_id'=> $id), 1);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else return false;
	}
	
	public function loadByUrl($url){
		$query = $this->db->get_where($this->_table, array('course_url'=> $url), 1);
		if ($query->num_rows() > 0) {
			return $query->row();		
		}
		else return false;
	}
	
	public function loadAll(){
		$this->db->order_by('course_name','asc');
		$query = $this->db->get($this->_table);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else return false;
		
	}
	public function listAll(){
		$results = $this->loadAll();
		$courses = array();
		foreach($results as $course){
			$courses[ $course->course_id ] = $course->course_name .' ('. $course->course_miles .'mi)';
		}
		return $courses;
	}
	
	public function save(){		
		$this->course_date_created = now();
		$this->course_date_modified = $this->course_date_created;
				
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		$course = $this;
		if($course->course_kml == -1) {
			unset($course->course_kml);
		}	
		unset($course->course_date_created);
		
		$course->course_date_modified = now();
		$this->db->where('course_id', $course->course_id);	
		$this->db->update($this->_table, $course);
		
		return true;
	}

	public function loadBySearch($term) {
		$this->db->from($this->_table);
		$this->db->like('course_name', $term);
		$this->db->or_like('course_description', $term);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else return array();
	}
	
	public function deleteById($course_id){
		$this->db->delete($this->_table, array('course_id' => $course_id));		
	}
}