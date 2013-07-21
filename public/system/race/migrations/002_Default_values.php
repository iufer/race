<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Default_values extends CI_Migration {
	
	function up(){
						
		echo "<pre>";
		echo "Starting import\n-----------------------------------------\n";
		
		echo "Importing: race_status\n";
		if( $this->db->count_all('race_status') == 0 ) {
			$data = array(
				array('race_status_id'=>1, 'race_status_name'=>'Draft', 'race_status_order'=>2),
				array('race_status_id'=>2, 'race_status_name'=>'Active', 'race_status_order'=>1),
				array('race_status_id'=>3, 'race_status_name'=>'Closed', 'race_status_order'=>3)
			);
			$this->db->insert_batch('race_status', $data);
		}
		echo "Importing: race_type\n";
		if( $this->db->count_all('race_type') == 0 ) {
			$data = array(
				array('race_type_id'=>1, 'race_type_type'=>'TT', 'race_type_description'=>'Uphill Time Trial', 'race_type_order'=>2, 'race_type_default_result_type_id'=>2),
				array('race_type_id'=>2, 'race_type_type'=>'TT', 'race_type_description'=>'Individual Time Trial', 'race_type_order'=>1, 'race_type_default_result_type_id'=>2),
				array('race_type_id'=>3, 'race_type_type'=>'RR', 'race_type_description'=>'Road Race', 'race_type_order'=>3, 'race_type_default_result_type_id'=>2),
				array('race_type_id'=>4, 'race_type_type'=>'C', 'race_type_description'=>'Criterium', 'race_type_order'=>4, 'race_type_default_result_type_id'=>3),
				array('race_type_id'=>5, 'race_type_type'=>'GR', 'race_type_description'=>'Group Ride', 'race_type_order'=>5, 'race_type_default_result_type_id'=>null),
				array('race_type_id'=>6, 'race_type_type'=>'MTB', 'race_type_description'=>'MTB Race', 'race_type_order'=>6, 'race_type_default_result_type_id'=>3),
				array('race_type_id'=>7, 'race_type_type'=>'S', 'race_type_description'=>'Special', 'race_type_order'=>7, 'race_type_default_result_type_id'=>2)
			);
			$this->db->insert_batch('race_type', $data);		
		}
		
		echo "Importing: result_type\n";
		if( $this->db->count_all('result_type') == 0 ) {

			$data = array(
				array('result_type_id'=>1, 'result_type_name'=>'Points', 'result_type_order'=>2),
				array('result_type_id'=>2, 'result_type_name'=>'Time', 'result_type_order'=>1),
				array('result_type_id'=>3, 'result_type_name'=>'Place', 'result_type_order'=>3),
				array('result_type_id'=>4, 'result_type_name'=>'Time Bonus', 'result_type_order'=>4)
			);
			$this->db->insert_batch('result_type', $data);
		}

		echo "Importing: rider_category\n";
		
		if( $this->db->count_all('rider_category') == 0 ) {
			$data = array(
				array('rider_category_id'=>1, 'rider_category_name'=>'A Group', 'rider_category_order'=>1),
				array('rider_category_id'=>2, 'rider_category_name'=>'B Group', 'rider_category_order'=>2),
				array('rider_category_id'=>3, 'rider_category_name'=>'C Group', 'rider_category_order'=>3),
				array('rider_category_id'=>4, 'rider_category_name'=>'Juniors', 'rider_category_order'=>4),
				array('rider_category_id'=>5, 'rider_category_name'=>'Combined Field', 'rider_category_order'=>5)
			);
			$this->db->insert_batch('rider_category', $data);
		}

		echo "Importing: user\n";
		if( $this->db->count_all('user') == 0 ) {
			$data = array(
				array('user_id'=>1, 'user_email'=>'chris@iufer.com', 'user_name'=>'Chris Iufer', 'user_password'=>'iufer')
			);
			$this->db->insert_batch('user', $data);
		}
		echo "Import finished\n";
		echo "</pre>";
	}

	// ----------------------------------------------
		
	function down(){
		
		$this->db->truncate('race_status');
		$this->db->truncate('race_type');
		$this->db->truncate('result_type');
		$this->db->truncate('rider_category');
		$this->db->truncate('user');
		
		echo "Truncated tables race_status, race_type, result_type, rider_category and user.";
	}		

	// ----------------------------------------------
	
}