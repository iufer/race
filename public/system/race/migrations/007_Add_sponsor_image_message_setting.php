<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_sponsor_image_message_setting extends CI_Migration {
	
	function up(){
		echo "Add race.race_sponsor_id<br>";
		$this->dbforge->add_column('race', array(
			'race_sponsor_id' => array('type'=>'INT', 'constraint'=>11)	
		));

		echo "Change race_status 'closed' to 'canceled'<br>";
		$this->db->update('race_status', array('race_status_name'=>'Cancelled'), array('race_status_id'=>3));
										
		
		echo "Creating table: sponsor<br>";		
		$fields = array(
					'sponsor_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'sponsor_name' => array('type'=>'VARCHAR', 'constraint'=>256, 'null'=>false),
					'sponsor_link' => array('type'=>'VARCHAR', 'constraint'=>512, 'null'=>false),
					'sponsor_description' => array('type'=>'TEXT'),
					'sponsor_order' => array('type'=>'INT', 'constraint'=>11),
					'sponsor_image_id' => array('type'=>'INT', 'constraint'=>11)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('sponsor_id', TRUE);
		$this->dbforge->create_table('sponsor', true);
		
		
		echo "Creating table: image<br>";		
		$fields = array(
					'image_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'image_url' => array('type'=>'VARCHAR', 'constraint'=>512, 'null'=>false)
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('image_id', TRUE);
		$this->dbforge->create_table('image', true);		


		echo "Creating table: message<br>";		
		$fields = array(
					'message_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'message_title' => array('type'=>'VARCHAR', 'constraint'=>512, 'null'=>false),
					'message_message' => array('type'=>'TEXT', 'null'=>false),
					'message_race_id' => array('type'=>'INT', 'constraint'=>11),
					'message_user_id' => array('type'=>'INT', 'constraint'=>11),
					'message_date_created' => array('type'=>'DATETIME', 'null'=>false),
					'message_date_expires' => array('type'=>'DATETIME'),
					'message_date_modified' => array('type'=>'DATETIME')					
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->create_table('message', true);		
		
		echo "Creating table: setting<br>";		
		$fields = array(
					'setting_id' => array('type'=>'INT', 'constraint'=>11, 'unsigned'=>TRUE, 'auto_increment'=>TRUE),
					'setting_key' => array('type'=>'VARCHAR', 'constraint'=>128, 'null'=>false),
					'setting_value' => array('type'=>'TEXT', 'null'=>false),
					'setting_previous_value' => array('type'=>'TEXT'),
					'setting_date_created' => array('type'=>'DATETIME', 'null'=>false),
					'setting_date_modified' => array('type'=>'DATETIME')					
					);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('setting_id', TRUE);
		$this->dbforge->add_key('setting_key');
		$this->dbforge->create_table('setting', true);		
	
					
	}
	
	function down(){
		echo "drop column 'race_sponsor_id'";
		$this->dbforge->drop_column('race', 'race_sponsor_id');
		
		echo "change race_status 'canceled' to 'closed'";
		$this->db->update('race_status', array('race_status_name'=>'Closed'), array('race_status_id'=>3));		
		
		echo "drop table sponsor";
		$this->dbforge->drop_table('sponsor');
		
		echo "drop table image";
		$this->dbforge->drop_table('image');
		
		echo "drop table message";
		$this->dbforge->drop_table('message');

		echo "drop table setting";
		$this->dbforge->drop_table('setting');
	}
}