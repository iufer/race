<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_site_colors extends CI_Migration {
	
	function up(){
		
		echo "Adding site colors\n";
		
		$data = array(
			array(
				'setting_key'=>'color_a',
				'setting_value'=>'#5fc7ce',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'color_b',
				'setting_value'=>'#f35637',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'color_c',
				'setting_value'=>'#f1c338',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'color_d',
				'setting_value'=>'#9dc850',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			)			
		);	
		
		$this->db->insert_batch('setting', $data);
				
	}
	
	function down(){



	}
}