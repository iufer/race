<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_site_settings extends CI_Migration {
	
	function up(){
		
		echo "Adding site settings\n";
		
		$data = array(
			array(
				'setting_key'=>'site_about',
				'setting_value'=>'<p>test</p>',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'site_copyright',
				'setting_value'=>'2011 Chris Iufer. All Rights Reserved',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'site_share_flickr_user',
				'setting_value'=>'59739290%40N00',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'site_share_twitter',
				'setting_value'=>'http://twitter.com/iufer',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'site_share_facebook',
				'setting_value'=>'http://www.facebook.com/',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'race_default_course_id',
				'setting_value'=>'NULL',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'race_default_laps',
				'setting_value'=>'0',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'race_default_uses_point_bracket',
				'setting_value'=>'0',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'race_default_race_type_id',
				'setting_value'=>'null',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			),
			array(
				'setting_key'=>'race_default_race_status_id',
				'setting_value'=>'2',
				'setting_date_created'=> date( 'Y-m-d H:i:s' )
			)
			
		);	
		
		$this->db->insert_batch('setting', $data);
				
	}
	
	function down(){



	}
}