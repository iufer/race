<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_race_laps extends CI_Migration {
	
	function up(){
		echo "Adding race_laps to table 'race'";
		$this->dbforge->add_column('race', array(
			'race_laps' => array('type'=>'INT', 'constraint'=>11, 'default'=>0)
			));
	}
	
	function down(){
		echo "Dropping race_laps from table 'race'"; 
		$this->dbforge->drop_column('race','race_laps');
	}
}