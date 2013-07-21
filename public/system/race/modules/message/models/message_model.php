<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_model {
	
	protected $_table = 'message';
	
	public $message_id;
	public $message_title;
	public $message_message;
	public $message_race_id;
	public $message_user_id;
	public $message_date_created;
	public $message_date_expires;
	public $message_date_modified;
	
	public function load($id){
		$query = $this->db->get_where($this->_table, array('message_id'=> $id), 1);
		return $query->row();
	}
	
	public function loadAll(){
		$this->db->join('user', 'user.user_id = message.message_user_id', 'left');
		$this->db->order_by('message_date_expires', 'desc');
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	
	public function latest(){
		$this->db->order_by('message_date_created', 'desc');
		$this->db->where('message_race_id',null);
		$this->db->join('user', 'user.user_id = message.message_user_id');
		$this->db->where('message_date_expires >', now());

		$this->db->limit(1);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
	
	public function latestByRaceId($race_id){
		$this->db->order_by('message_date_created', 'desc');
		$this->db->where('message_race_id', $race_id);
		$this->db->join('user', 'user.user_id = message.message_user_id');
		$this->db->where('message_date_expires >', now());
				
		$this->db->limit(1);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
	
	public function save(){
		$this->message_date_created = now();
		
		// default expiry is one year away
		if(is_null($this->message_date_expires)) $this->message_date_expires = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1) );

		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}
	
	public function update(){
		unset($this->message_date_created);
		
		$this->message_date_modified = now();
		$this->db->where('message_id', $this->message_id);	
		$this->db->update($this->_table, $this);
		
		return $this->message_id;		
	}
	
	public function expireById($message_id){
		$this->db->where('message_id', $message_id);
		$data = array(
			'message_date_modified' => now(),
			'message_date_expires' => date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d")-1, date("Y")) )
			);
		return $this->db->update($this->_table, $data);
	}
	
	
}