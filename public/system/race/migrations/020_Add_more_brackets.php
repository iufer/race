<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_more_brackets extends CI_Migration {
	
	function up(){
		
		// set config race_point_bracket
		$this->db->where('setting_key','race_point_bracket');
		$this->db->set('setting_value','[{"name":"Standard","b": [20,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Road Race 40","b": [40,36,34,32,30,28,26,24,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Time Trial","b": [20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Road Race 30","b": [30,24,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Category 3","b": [20,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Category 2","b": [24,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Category 1","b": [30,26,24,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Hors Category","b": [40,36,34,32,30,28,26,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"10 Mile TT","b": [10,8,6,4,2],"remainder":"1"},{"name":"15 Mile TT","b": [15,13,11,9,7,5,3],"remainder":"1"},{"name":"20 Mile TT","b": [20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"25 Mile TT","b": [25,23,21,19,17,15,13,11,9,7,5,3],"remainder":"1"},{"name":"30 Mile TT","b": [30,28,26,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"40 Mile TT","b": [40,36,34,32,30,28,26,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"}]');
		$this->db->update('setting');
	
	}
	
	function down(){



	}
}