<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Series_admin extends RA_Controller {

	public $loginRequired = true;	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('series/series_model');
	}
	
	public function index() {		
		$this->load->helper('html');
		
		$data = array('series' => $this->series_model->loadAll());
		$this->load->view('series/admin/index', $data);
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
	}
	
	public function add() {
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run('admin/series/add') == FALSE){
			
			$this->load->view('series/admin/add');
		}
		else {
			$this->series_model->series_name = $this->input->post('name');
			$this->series_model->series_url = $this->input->post('url');
			$this->series_model->series_subtitle = $this->input->post('subtitle');
			$this->series_model->series_description = $this->input->post('description');
			$this->series_model->series_date_start = $this->input->post('date_start');
			$this->series_model->series_date_end = $this->input->post('date_end');			
			$series_id = $this->series_model->save();

			$this->load->model('series_race/series_race_model');
			$races = $this->input->post('races');
			if($races != '' and count($races) > 0){
				$this->series_race_model->bindToSeries($series_id, $races);
			}
			// flash message
			$this->session->set_flashdata('updated', 'New series was saved.');
						
			redirect("admin/series/edit/$series_id");
		}		
	}
	
	public function edit($series_id) {
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run('admin/series/add') == FALSE){
			$this->load->model('series_race/series_race_model');
			$data = array(
				'series'=>$this->series_model->load($series_id),
				'races'=>$this->series_race_model->listBySeriesId($series_id)
				);
			
			$this->load->view('series/admin/edit', $data);
		}
		else {

			$this->series_model->series_id = $series_id;
			$this->series_model->series_name = $this->input->post('name');
			$this->series_model->series_url = $this->input->post('url');
			$this->series_model->series_subtitle = $this->input->post('subtitle');
			$this->series_model->series_description = $this->input->post('description');
			$this->series_model->series_date_start = $this->input->post('date_start');
			$this->series_model->series_date_end = $this->input->post('date_end');			
			$this->series_model->update();

			$this->load->model('series_race/series_race_model');
			$races = $this->input->post('races');
			$clear_previous_races = true;
			// var_dump($races); exit;
			if($races !== false and count($races) > 0){
				$this->series_race_model->bindToSeries($series_id, $races, $clear_previous_races);
			}
			
			$this->session->set_flashdata('updated', 'Series was saved.');
			
			redirect("admin/series/edit/$series_id");
		}		
	}	
	
	public function del($series_id){
		$this->load->model('series_race/series_race_model');

		$this->series_model->deleteById($series_id);
		$this->series_race_model->deleteBySeriesId($series_id);
		
		$data = array('error' => false);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
	}	
	
}