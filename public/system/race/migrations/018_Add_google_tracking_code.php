<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_google_tracking_code extends CI_Migration {
	
	function up(){
		
		echo "Adding tracking code and site domain setting\n";
		
		$data = array(
			array(
				'setting_key'=>'site_domain',
				'setting_value'=>'',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'site_google_analytics_account',
				'setting_value'=>'',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			)			
		);	
		
		$this->db->insert_batch('setting', $data);
				
	}
	
	function down(){



	}
}