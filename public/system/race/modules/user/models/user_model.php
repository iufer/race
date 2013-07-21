<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_model {	
	protected $_table = 'user';
	private $login_key = 'login';

 	public $user_id;
	public $user_email;
	public $user_name;
	public $user_password;
	public $user_date_created;
	public $user_date_modified;

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function load($user_id){
		$this->db->where('user_id', $user_id);
		$this->db->from($this->_table);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$user = $query->row();
			return $user;
		}
		else return false;
	}

	public function loadAll(){
		$query = $this->db->get($this->_table);
		$users = $query->result();
		return $users;
	}

	public function login($email, $password) {
		$query = $this->db->get_where($this->_table, array('user_email'=>$email));
		if ($query->num_rows() > 0) {
			$user = $query->row();
			if ($user->user_password == $password) {				
				$this->setLoggedIn($user);
				return true;
			}
		}
		else return false;
	}
	
	public function setLoggedIn($user){
		return $this->session->set_userdata(array( 
				$this->login_key => true, 
				'user_id' => $user->user_id, 
				'user_name'=>$user->user_name, 
				'user_email'=>$user->user_email
				));	
	}
	
	public function setLoggedOut(){
		return $this->session->sess_destroy();
	}

	public function isLoggedIn() {
		return ($this->session->userData($this->login_key) == true);
	}
	
	public function isLoggedOut() {
		return (!$this->isLoggedIn());
	}

	public function id(){
		return $this->session->userData('user_id');
	}
	public function name(){
		return $this->session->userData('user_name');
	}
	public function email(){
		return $this->session->userData('user_email');
	}

	// Modifying
	public function save(){		
		$this->user_date_created = now();
		$this->user_date_modified = $this->user_date_created;
		
		$this->db->insert($this->_table, $this);
		return $this->db->insert_id();
	}

	public function update(){
		$user = $this;
		
		// unset things we dont want to update	
		unset($user->user_date_created);
		
		$user->user_date_modified = now();
		$this->db->where('user_id', $user->user_id);	
		$this->db->update($this->_table, $user);
		return $this->user_id;
	}	

	public function deleteById($user_id){
		$this->db->delete($this->_table, array('user_id' => $user_id));
	}
}