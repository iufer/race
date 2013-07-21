<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_womens_masters_rider_category extends CI_Migration {
	
	function up(){
		echo "<pre>";
		echo "Adding womens, masters, clydesdales to table 'rider_category'";

			$data = array(
				array('rider_category_id'=>6 ,'rider_category_name'=>"Women's Group", 'rider_category_order'=>6),
				array('rider_category_id'=>7 ,'rider_category_name'=>"Masters 55+", 'rider_category_order'=>7),
				array('rider_category_id'=>8 ,'rider_category_name'=>"Clydesdales", 'rider_category_order'=>8)
			);
			$this->db->insert_batch('rider_category', $data);		
	}
	
	function down(){
		echo "Dropping womens, masters, clydesdales from table 'rider_category'"; 
		$this->db->where_in('rider_category_id', array(6, 7, 8));
		$this->db->delete('rider_category'); 
	}
}