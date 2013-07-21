<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_schema extends CI_Migration {
	
	function up(){
		echo "<pre>";
		echo "Starting database install\n-----------------------------------------\n";
		
		echo "Creating table: course\n";				
		$this->dbforge->add_field(array(
					'course_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'course_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'course_url' => array('type'=>'VARCHAR', 'constraint'=>128, 'null'=>false),
					'course_description' => array('type'=>'TEXT'),
					'course_map_embed' => array('type'=>'TEXT'),
					'course_miles' => array('type'=>'FLOAT', 'default'=>0),
					'course_elevation' => array('type'=>'INT', 'constraint'=>11, 'default'=>0),
					// 'course_image_id' => array('type'=>'INT', 'constraint'=>11),
					'course_category_climb' => array('type'=>'INT', 'constraint'=>11, 'default'=>0),
					'course_date_created' => array('type'=>'DATETIME', 'null'=>false),
					'course_date_modified' => array('type'=>'DATETIME')
					));
		$this->dbforge->add_key('course_id', TRUE);
		$this->dbforge->add_key('course_url');
		$this->dbforge->create_table('course', true);	


		echo "Creating table: race\n";
		
		$fields = array(
					'race_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'race_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'race_url' => array('type'=>'VARCHAR', 'constraint'=>128, 'null'=>false),
					'race_race_status_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'race_subtitle' => array('type'=>'VARCHAR', 'constraint'=>256),
					'race_description' => array('type'=>'TEXT'),
					'race_start_time' => array('type'=>'DATETIME', 'null'=>false),
					'race_registration_time' => array('type'=>'DATETIME'),
					'race_race_type_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'race_course_id' => array('type'=>'INT', 'constraint'=>11),
					'race_will_attend_count' => array('type'=>'INT', 'constraint'=>11, 'default'=>0),
					'race_date_created' => array('type'=>'DATETIME', 'null'=>false),
					'race_date_modified' => array('type'=>'DATETIME')
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('race_id', TRUE);
		$this->dbforge->add_key('race_url');
		$this->dbforge->create_table('race', true);			


		echo "Creating table: race_status\n";
	
		$fields = array(
					'race_status_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'race_status_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'race_status_order' => array('type'=>'INT', 'constraint'=>11)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('race_status_id', TRUE);
		$this->dbforge->create_table('race_status', true);


		echo "Creating table: race_type\n";
		
		$fields = array(
					'race_type_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'race_type_type' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'race_type_description' => array('type'=>'TEXT', 'null'=>false),
					// 'race_type_icon_path' => array('type'=>'VARCHAR', 'constraint'=>512),
					'race_type_order' => array('type'=>'INT', 'constraint'=>11),
					'race_type_default_result_type_id' => array('type'=>'INT', 'constraint'=>11)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('race_type_id', TRUE);
		$this->dbforge->create_table('race_type', true);


		echo "Creating table: result\n";
	
		$fields = array(
					'result_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'result_result_type_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'result_rider_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'result_race_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'result_data' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'result_note' => array('type'=>'VARCHAR', 'constraint'=>256),
					'result_rider_category_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'result_date_created' => array('type'=>'DATETIME', 'null'=>false),
					'result_date_modified' => array('type'=>'DATETIME')
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('result_id', TRUE);
		$this->dbforge->create_table('result', true);


		echo "Creating table: result_type\n";
	
		$fields = array(
					'result_type_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'result_type_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'result_type_order' => array('type'=>'INT', 'constraint'=>11)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('result_type_id', TRUE);
		$this->dbforge->create_table('result_type', true);


		echo "Creating table: rider\n";
		
		$fields = array(
					'rider_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'rider_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'rider_public' => array('type'=>'TINYINT', 'constraint'=>1, 'null'=>false, 'default'=>true),
					'rider_profile_views' => array('type'=>'INT', 'constraint'=>11, 'default'=>0),
					'rider_rider_category_id' => array('type'=>'INT', 'constraint'=>11),
					'rider_date_created' => array('type'=>'DATETIME', 'null'=>false),
					'rider_date_modified' => array('type'=>'DATETIME')
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('rider_id', TRUE);
		$this->dbforge->create_table('rider', true);
		
		
		echo "Creating table: rider_category\n";
		
		$fields = array(
					'rider_category_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'rider_category_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'rider_category_order' => array('type'=>'INT', 'constraint'=>11)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('rider_category_id', TRUE);
		$this->dbforge->create_table('rider_category', true);		
		
		
		echo "Creating table: series\n";
		
		$fields = array(
					'series_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'series_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'series_url' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'series_subtitle' => array('type'=>'VARCHAR', 'constraint'=>256),
					'series_description' => array('type'=>'TEXT'),
					'series_date_start' => array('type'=>'DATETIME', 'null'=>false),
					'series_date_end' => array('type'=>'DATETIME'),
					// 'series_image_id' => array('type'=>'INT', 'constraint'=>11),					
					'series_date_created' => array('type'=>'DATETIME', 'null'=>false),
					'series_date_modified' => array('type'=>'DATETIME')
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('series_id', TRUE);
		$this->dbforge->add_key('series_url');
		$this->dbforge->create_table('series', true);


		echo "Creating table: series_race\n";
	
		$fields = array(
					'series_race_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'series_race_race_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'series_race_series_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'series_race_order' => array('type'=>'INT', 'constraint'=>11),
					'series_race_date_created' => array('type'=>'DATETIME', 'null'=>false)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('series_race_id', TRUE);
		$this->dbforge->create_table('series_race', true);	
		

		echo "Creating table: user\n";
		
		$fields = array(
					'user_id' => array('type'=>'INT', 'constraint'=>11, 'auto_increment'=>TRUE),
					'user_email' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'user_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'user_password' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('user', true);

		echo "Creating table: race_time\n";
		
		$fields = array(
					'race_time_id' => array('type'=>'INT', 'constraint'=>11, 'auto_increment'=>TRUE),
					'race_time_race_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'race_time_rider_category_id' => array('type'=>'INT', 'constraint'=>11, 'null'=>false),
					'race_time_time' => array('type'=>'DATETIME','null'=>false)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('race_time_id', TRUE);
		$this->dbforge->create_table('race_time', true);
		
		echo "Install finished";
		echo "</pre>";
	}
	
	// ----------------------------------------------
	
	function down(){
		echo "<pre>";
		echo "Dropping tables\n";
		
		drop_table("course");
		drop_table("race");
		drop_table("race_status");		
		drop_table("race_type");
		drop_table("result");
		drop_table("result_type");
		drop_table("rider");
		drop_table("rider_category");
		drop_table("series");
		drop_table("series_race");
		drop_table("user");
		drop_table("race_time");
		
		echo "DONE\n";
	}

	// ----------------------------------------------
	
}