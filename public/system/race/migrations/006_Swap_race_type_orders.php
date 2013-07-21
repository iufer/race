<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Swap_race_type_orders extends CI_Migration {
	
	function up(){
		//echo "Adding race_laps to table 'race'";

		$this->db->update('result_type', array('result_type_order'=>3), array('result_type_id'=>1));
		$this->db->update('result_type', array('result_type_order'=>2), array('result_type_id'=>2));
		$this->db->update('result_type', array('result_type_order'=>1), array('result_type_id'=>3));		
		$this->db->update('result_type', array('result_type_order'=>5), array('result_type_id'=>4));
		$this->db->update('result_type', array('result_type_order'=>4), array('result_type_id'=>5));
					
	}
	
	function down(){
		//
	}
}