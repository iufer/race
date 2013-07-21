<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Modify_image extends CI_Migration {
	
	function up(){
		
		echo "Adding col image_name, image_type, image_size\n";
		$this->dbforge->add_column('image', array(
			'image_name' => array('type'=>'VARCHAR', 'constraint'=>512, 'null'=>false),
			'image_type' => array('type'=>'VARCHAR', 'constraint'=>128),
			'image_size' => array('type'=>'INT', 'constraint'=>11, 'default'=>0),
			'image_path' => array('type'=>'VARCHAR', 'constraint'=>1024, 'null'=>false)
		));
		
		echo "Remove col: image_url";
		$this->dbforge->drop_column('image', 'image_url');
		
	}
	
	function down(){
		
	}
}