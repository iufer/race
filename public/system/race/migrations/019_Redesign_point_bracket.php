<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Redesign_point_bracket extends CI_Migration {
	
	function up(){
		
		// set config race_point_bracket
		$this->db->where('setting_key','race_point_bracket');
		$this->db->set('setting_value','[{"name":"Standard","b": [20,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Road Race 40","b": [40,36,34,32,30,28,26,24,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Time Trial","b": [20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Road Race 30","b": [30,24,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Category 3","b": [20,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Category 2","b": [24,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Category 1","b": [30,26,24,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"},{"name":"Hors Category","b": [40,36,34,32,30,28,26,22,20,18,16,14,12,10,8,6,4,2],"remainder":"1"}]');
		$this->db->update('setting');
		
		// delete config race_point_bracket_multipliers
		$this->db->delete('setting', array('setting_key'=>'race_point_bracket_multipliers'));
		
		$this->db->where('race_point_bracket_multiplier','10');
		$this->db->set('race_point_bracket_multiplier','0');
		$this->db->update('race');

		$this->db->where('race_point_bracket_multiplier','20');
		$this->db->set('race_point_bracket_multiplier','1');
		$this->db->update('race');

		$this->db->where('race_point_bracket_multiplier','15');
		$this->db->set('race_point_bracket_multiplier','2');
		$this->db->update('race');
		
		$this->db->where('race_point_bracket_multiplier','30');
		$this->db->set('race_point_bracket_multiplier','3');
		$this->db->update('race');
		
		
	}
	
	function down(){



	}
}