<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_cms_blocks extends CI_Migration {
	
	function up(){
		
		echo "Adding cms blocks\n";
		
		$data = array(
			array(
				'setting_key'=>'cms_race_sidebar',
				'setting_value'=>'',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'cms_course_sidebar',
				'setting_value'=>'',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'cms_series_sidebar',
				'setting_value'=>'',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'cms_rider_sidebar',
				'setting_value'=>'',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'cms_search_sidebar',
				'setting_value'=>'',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			)			
		);	
		
		$this->db->insert_batch('setting', $data);
				
	}
	
	function down(){



	}
}