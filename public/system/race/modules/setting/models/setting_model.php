<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_model {
	
	protected $_table = 'setting';
	protected $_cache = array();
	protected $_keys  = array();
	
	public $setting_id;
	public $setting_key;
	public $setting_value;
	public $setting_previous_value;
	public $setting_date_created;
	public $setting_date_modified;
	
	public function __construct(){
		parent::__construct();
		
		// setting table was added in migration 7
		// load all will fail for all earlier migrations
		// if($this->config->item('migrations_version') > 6) {
			$this->_loadAll();
		// }
	}

	protected function _loadAll(){
		$this->db->order_by('setting_id');
		$query = $this->db->get($this->_table);
		$result = $this->_cache['loadAll'] = $query->result();
		
		foreach($result as $r){
			$this->_keys[$r->setting_key] = $r->setting_value;
		}
	}
		
	public function item($key){
		return (isset($this->_keys[$key])) ? $this->_keys[$key] : false;
	}
	
	public function loadAll(){
		return $this->_cache['loadAll'];
	}
	
	public function update($key, $value){
		$previous = $this->item($key);
		
		// set the runtime cache for our new value incase it needs to be used immediately
		if(isset($this->_keys[$key])) $this->_keys[$key] = $value;
		
		$data = array(
			'setting_value'=> $value, 
			'setting_date_modified'=> now(), 
			'setting_previous_value'=> $previous
			);
		$this->db->where('setting_key', $key);
		$this->db->update($this->_table, $data);
	}
}