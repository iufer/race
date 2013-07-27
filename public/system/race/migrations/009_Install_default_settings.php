<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_default_settings extends CI_Migration {
	
	function up(){
		echo "Importing: default settings<br>";
		
		if( $this->db->count_all('setting') == 0 ) {
			$data = array(
				array('setting_key'=>'site_name', 'setting_value'=>'RACE', 'setting_date_created'=>date( 'Y-m-d H:i:s')),
				array('setting_key'=>'site_description', 'setting_value'=>"RACE", 'setting_date_created'=>date( 'Y-m-d H:i:s')),
				array('setting_key'=>'rider_podium_places', 'setting_value'=>'5', 'setting_date_created'=>date( 'Y-m-d H:i:s')),
				array('setting_key'=>'rider_anon_name', 'setting_value'=>"-- Unlisted --", 'setting_date_created'=>date( 'Y-m-d H:i:s')),
				array('setting_key'=>'race_point_bracket', 'setting_value'=>'[20,16,14,12,10,8,6,4,2,1,1,1]', 'setting_date_created'=>date( 'Y-m-d H:i:s')),
				array('setting_key'=>'race_point_bracket_multipliers', 'setting_value'=>'{"10":"Standard Point","5":"Half Point","15":"3\/2 Point","20":"Double Point","25":"5\/2 Point","30":"Triple Point","40":"Quadruple Point"}', 'setting_date_created'=>date( 'Y-m-d H:i:s'))
				);
			$this->db->insert_batch('setting', $data);
		}		
	}
	
	function down(){
		echo "Truncating table 'setting'<br>";
		$this->db->truncate('setting');
	}
}