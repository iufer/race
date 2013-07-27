<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends RA_Controller {
	
	public function index() {
		
		$this->load->helper('form');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div><br>');
		$this->form_validation->set_message('min_length', 'Try a more specific search term');
		$this->form_validation->set_rules('q', 'search term', 'trim|required|min_length[4]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('search/index');
		}
		else {
			$string = $this->input->post('q');
			
			$this->load->model('rider/rider_model');
			$riders = $this->rider_model->loadBySearch( $string );
		
			$this->load->model('race/race_model');
			$races = $this->race_model->loadBySearch( $string );

			$this->load->model('series/series_model');
			$series = $this->series_model->loadBySearch( $string );
			
			$this->load->model('course/course_model');
			$courses = $this->course_model->loadBySearch( $string );
					
			$this->load->view('search/results', array('riders'=>$riders, 'races'=>$races, 'series'=>$series, 'courses'=>$courses, 'query'=>$string));
		}
		
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
	}
	
	
}