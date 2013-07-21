<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_model {
	
	protected $_table = 'image';
		
	public $image_id;
	public $image_name;
	public $image_size;
	public $image_type;
	public $image_date_created;
	public $image_date_modified;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function load($image_id){
		$query = $this->db->get_where($this->_table, array('image_id'=> $image_id), 1);
		return $query->row();
	}
	
	public function loadAll(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function save(){		
		$this->image_date_created = now();
				
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		$image = $this;
		unset($image->image_date_created);
		$image->image_date_modified = now();		
		$this->db->update($this->_table, $image, array('image_id'=>$image->image_id));
	}
	
}