<?php

class Install extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('migration');		
		//$this->migrations->set_verbose(TRUE);
	}

	public function index(){
		if ( ! $this->migration->current() ) {
			show_error($this->migration->error_string());
			exit;
		}

		echo "<br />Migration Successful<br />";	
	}
	
	function version($id = NULL) {
		// No $id supplied? Use the config version
		$id OR $id = $this->config->item('migrations_version');

		if ( ! $this->migration->version($id)) {
			show_error($this->migration->error_string());
			exit;
		}

		echo "<br />Migration Successful<br />";
	}	
}
