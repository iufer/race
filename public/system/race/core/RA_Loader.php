<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class RA_Loader extends MX_Loader {
	private $_header = array();
	private $_footer = array();
	private $_footer_view = 'site/footer';
	private $_header_view = 'site/header';
	private $_footer_view_admin = 'site/admin/footer';
	private $_header_view_admin = 'site/admin/header';
	
	public function subview($view, $data=false){
		//$CI =& get_instance();
		$this->view($view, $data);
	}
	
	public function header($title ='', $body_id ='', $page_title = '') {
		//$CI =& get_instance();
		$data_string = implode(' ', $this->_header);
		$view = ($this->uri->segment(1) == 'admin') ? $this->_header_view_admin : $this->_header_view;
		$this->view($view, array('title'=>$title, 'body_id'=>$body_id, 'data'=>$data_string, 'page_title'=>$page_title));
	}
	
	public function footer() {
		//$CI =& get_instance();
		$data_string = implode(' ', $this->_footer);
		$view = ($this->uri->segment(1) == 'admin') ? $this->_footer_view_admin : $this->_footer_view;
		$this->view($view, array('data'=>$data_string));
	}
		
	public function addJs($str, $where = 'footer'){
		$data = '<script src="'. base_url() .'js/'. $str . '" type="text/javascript" charset="utf-8"></script>';
		switch($where){
			case 'footer':
				$this->_footer[] = $data;
				break;
			case 'header':
				$this->_header[] = $data;
				break;
		}
	}
	
	public function addCss($str, $where = 'header', $media = 'all'){
		$data = '<link rel="stylesheet" href="'. base_url() .'css/'. $str .'" type="text/css" media="'. $media .'" charset="utf-8">';
		switch($where){
			case 'footer':
				$this->_footer[] = $data;
				break;
			case 'header':
				$this->_header[] = $data;
				break;
		}		
	}
	
	public function addMeta($str){
		
	}
}