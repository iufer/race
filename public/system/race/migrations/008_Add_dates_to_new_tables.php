<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_dates_to_new_tables extends CI_Migration {
	
	function up(){
		echo "Add date_created, date_modified to image<br>";
		$this->dbforge->add_column('image', array(
			'image_date_created' => array('type'=>'DATETIME', 'null'=>false),
			'image_date_modified' => array('type'=>'DATETIME')
		));	

		echo "Add date_created, date_modified to sponsor<br>";
		$this->dbforge->add_column('sponsor', array(
			'sponsor_date_created' => array('type'=>'DATETIME', 'null'=>false),
			'sponsor_date_modified' => array('type'=>'DATETIME')
		));	
	
		echo "Add date_created, date_modified to race_type<br>";
		$this->dbforge->add_column('race_type', array(
			'race_type_date_created' => array('type'=>'DATETIME', 'null'=>false),
			'race_type_date_modified' => array('type'=>'DATETIME')
		));	

		echo "Add date_created, date_modified to rider_category<br>";
		$this->dbforge->add_column('rider_category', array(
			'rider_category_date_created' => array('type'=>'DATETIME', 'null'=>false),
			'rider_category_date_modified' => array('type'=>'DATETIME')
		));	

		echo "Add date_created, date_modified to user<br>";
		$this->dbforge->add_column('user', array(
			'user_date_created' => array('type'=>'DATETIME', 'null'=>false),
			'user_date_modified' => array('type'=>'DATETIME')
		));	
	
					
	}
	
	function down(){
		echo "drop column 'image_date_created'<br>";
		$this->dbforge->drop_column('image', 'image_date_created');

		echo "drop column 'image_date_modified'<br>";
		$this->dbforge->drop_column('image', 'image_date_modified');

		echo "drop column 'sponsor_date_created'<br>";
		$this->dbforge->drop_column('sponsor', 'sponsor_date_created');

		echo "drop column 'sponsor_date_modified'<br>";
		$this->dbforge->drop_column('sponsor', 'sponsor_date_modified');

		echo "drop column 'race_type_date_created'<br>";
		$this->dbforge->drop_column('race_type', 'race_type_date_created');

		echo "drop column 'race_type_date_modified'<br>";
		$this->dbforge->drop_column('race_type', 'race_type_date_modified');

		echo "drop column 'rider_category_date_created'<br>";
		$this->dbforge->drop_column('rider_category', 'rider_category_date_created');

		echo "drop column 'rider_category_date_modified'<br>";
		$this->dbforge->drop_column('rider_category', 'rider_category_date_modified');

		echo "drop column 'user_date_created'<br>";
		$this->dbforge->drop_column('user', 'user_date_created');

		echo "drop column 'user_date_modified'<br>";
		$this->dbforge->drop_column('user', 'user_date_modified');


	}
}