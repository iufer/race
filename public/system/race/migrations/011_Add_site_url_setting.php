<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_site_url_setting extends CI_Migration {
	
	function up(){
		echo "Adding row: site_url<br>";
		$data = array(
				'setting_key'=>'site_logo',
				'setting_value'=>'img/logo.png',
				'setting_date_created' => now(),
				'setting_date_modified' => now()
				);
		$this->db->insert('setting', $data);
	}
	
	function down(){
		echo "delete setting site_logo";
		$this->db->delete('setting', array('setting_key'=>'site_logo'));	
	}
}