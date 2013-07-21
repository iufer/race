<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_points_bracket extends CI_Migration {
	
	function up(){
		echo "Adding race_point_bracket and race_point_bracket_multiplier to table 'race'";
		$this->dbforge->add_column('race', array(
			'race_point_bracket'=>array('type'=>'TINYINT', 'constraint'=>1, 'null'=>false, 'default'=>0),
			'race_point_bracket_multiplier'=>array('type'=>'INT', 'constraint'=>11, 'default'=>0)								
			));
	}
	
	function down(){
		echo "Dropping race_point_bracket and race_point_bracket_multiplier from table 'race'"; 
		$this->dbforge->drop_column('race','race_point_bracket');
		$this->dbforge->drop_column('race','race_point_bracket_multiplier');
	}
}