<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller {

	public function index() {
		$this->load->view('site/index');
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
	}
	
	public function sponsors() {
		$this->load->view('site/sponsors');
	}
	
	public function colors($format = 'css') {
		if($format == 'css')
			$this->output->set_content_type('text/css');
			
		$this->load->view('site/color');
	}

	public function debug(){
		if(ENVIRONMENT == 'development') {
			// pr($this->input->post());
			// pr($_FILES);
			// echo FCPATH;
			// 		
			// $this->load->model('result/result_model');
			// $data = $this->result_model->listRidersByRaceId(3);
			// pr($data);
			// _protect_identifiers($k, FALSE, $escape);
			
			pr( $this->db->_has_operator('race_start_time >') );
			pr( $this->db->_protect_identifiers('race_start_time >', false, true) );
			pr( $this->db->escape('race_start_time >') );
			
			// $this->load->model('user/user_model');
			// 		echo 'userid; '. $this->user_model->user_id();
			// 		
			// echo json_encode(array(
			// 										'10'=>'Standard Point',
			// 										'5'=>'Half Point',
			// 										'15'=>'3/2 Point',
			// 										'20'=>'Double Point',
			// 										'25'=>'5/2 Point',
			// 										'30'=>'Triple Point',
			// 										'40'=>'Quadruple Point'
			// 										));
												
			// pr(setting('race_point_bracket_multipliers', true));
	
			// $this->load->model('rider/rider_model');
			// var_dump($this->rider_model->riderExistsByName('Steve Chollet'));
		
			// $this->load->model('result/result_model');
			// $results = $this->result_model->loadBySeriesId(9);
			// 
			// pr($results);
			// 
			// if(ENVIRONMENT == 'development') $this->output->enable_profiler(true);	
			// for($i=0;$i<101;$i++){
			// 		echo formatPlace($i) ."<br>";
			// 	}
			// pr( array( formatPlace(1), formatPlace(2),formatPlace(3), formatPlace(4), formatPlace(10), formatPlace(11), formatPlace(20), formatPlace(32), formatPlace(43) ) ); 
			// echo '<form method="post" action="/raceapp/admin/site/upload" enctype="multipart/form-data" />';
			// echo '<input type="file" name="userfile[]" />';
			// echo '<input type="submit" />';
			// echo '</form>';
			
		}
		else {
			show_404();
		}
	}
	
	public function login(){
		$this->load->model('user/user_model');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run('admin/login') == FALSE){
			// form has not run yet or errors
			$this->load->view('login');		
		}
		else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$status = $this->user_model->login($email, $password);
			
			if($status){				
				redirect('admin');
			}
			else {
				$this->form_validation->set_post_validation_error('password', "Incorrect password");
				$this->load->view('login');			
			}
		}
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
	}	
}