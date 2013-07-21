<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_city_state extends CI_Migration {
	
	function up(){
		
		echo "Adding setting city and state\n";
		
		$data = array(
			array(
				'setting_key'=>'site_city',
				'setting_value'=>'Chico',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'site_state',
				'setting_value'=>'California',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			)
		);	
		
		$this->db->insert_batch('setting', $data);
				
	}
	
	function down(){
		$this->db->where('setting_key', 'site_city');
		$this->db->delete('setting');

		$this->db->where('setting_key', 'site_state');
		$this->db->delete('setting');


	}
}