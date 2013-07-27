<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_block extends RA_Controller {

	public function search($showButton = true) {
		$this->load->helper('form');
		return $this->load->view('search/block/search', array('showButton'=>$showButton), true);
	}

	public function mini($showButton = true) {
		$this->load->helper('form');
		return $this->load->view('search/block/mini', array('showButton'=>$showButton), true);
	}	
	
}