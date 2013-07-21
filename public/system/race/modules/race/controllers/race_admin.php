<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race_admin extends RA_Controller {

	public $loginRequired = true;	

	public function __construct(){
		parent::__construct();
		$this->load->model('race/race_model');
	}
	
	public function index() {		
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('race_status/race_status_model');		

		$data = array(
				'races'=> $this->race_model->loadAllFuture(), 
				'past_races'=> $this->race_model->loadAllPast(),
				'race_statuses'=> $this->race_status_model->listAll()
				);
		$this->load->view('race/admin/index', $data);
	}
	
	public function add() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> ', '</p></div>');

		if($this->form_validation->run('admin/race/add') == FALSE){
			
			$this->load->view('race/admin/add');			
		}
		else {
			// passed validaiton, time to create the race			
			$this->race_model->race_name = $this->input->post('name');
			$this->race_model->race_subtitle = $this->input->post('subtitle');
			$this->race_model->race_description = $this->input->post('description');
			$this->race_model->race_start_time = $this->input->post('start_date') .' '. $this->input->post('start_time');
			$this->race_model->race_registration_time = $this->input->post('registration_date') .' '. $this->input->post('registration_time');
			$this->race_model->race_race_type_id = $this->input->post('race_type_id');
			$this->race_model->race_course_id = $this->input->post('course_id');
			$this->race_model->race_race_status_id = $this->input->post('race_status_id');
			$this->race_model->race_laps = $this->input->post('laps');
			$this->race_model->race_point_bracket = $this->input->post('point_bracket');
			$this->race_model->race_point_bracket_multiplier = $this->input->post('point_bracket_multiplier');
			$this->race_model->race_sponsor_id = $this->input->post('sponsor_id');
						
			$race_id = $this->race_model->save();			
			$this->session->set_flashdata('updated', 'Race was saved.');
			
			redirect("admin/race/edit/$race_id");
		}

	}
	public function edit($id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');			

		$this->form_validation->set_error_delimiters('<div class="ui-state-error ui-corner-all"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> ', '</p></div>');
		
		if($this->form_validation->run('admin/race/add') == FALSE){					
			$data = array('race' => $this->race_model->load($id));
		
			$this->load->view('race/admin/edit', $data);
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
		}
		else {
			// passed validaiton, time to create the race
			$this->race_model->race_id = $id;
			$this->race_model->race_name = $this->input->post('name');
			$this->race_model->race_subtitle = $this->input->post('subtitle');
			$this->race_model->race_description = $this->input->post('description');
			$this->race_model->race_start_time = $this->input->post('start_date') .' '. $this->input->post('start_time');
			$this->race_model->race_registration_time = $this->input->post('registration_date') .' '. $this->input->post('registration_time');
			$this->race_model->race_race_type_id = $this->input->post('race_type_id');
			$this->race_model->race_course_id = $this->input->post('course_id');
			$this->race_model->race_race_status_id = $this->input->post('race_status_id');
			$this->race_model->race_laps = $this->input->post('laps');
			$this->race_model->race_point_bracket = $this->input->post('point_bracket');
			$this->race_model->race_point_bracket_multiplier = $this->input->post('point_bracket_multiplier');
			$this->race_model->race_sponsor_id = $this->input->post('sponsor_id');
						
			$this->race_model->update();
			$this->session->set_flashdata('updated', 'Race was saved.');
			redirect("admin/race/edit/$id");
			
		}		
	}
	
	public function duplicate($race_id){
		$this->load->helper('form');
		$this->load->library('form_validation');
				
		$race = $this->race_model->load($race_id);
		// this will preload the form with values from a previous
		$this->form_validation->preset_value('name', $race->race_name);
		$this->form_validation->preset_value('url', $race->race_url);
		$this->form_validation->preset_value('subtitle', $race->race_subtitle);		
		$this->form_validation->preset_value('description', $race->race_description);
		$this->form_validation->preset_value('race_type_id', $race->race_race_type_id);		
		$this->form_validation->preset_value('course_id', $race->course_id);		
		$this->form_validation->preset_value('race_status_id', $race->race_race_status_id);						
		$this->form_validation->preset_value('laps', $race->race_laps);
		$this->form_validation->preset_value('point_bracket', $race->race_point_bracket);
		$this->form_validation->preset_value('point_bracket_multiplier', $race->race_point_bracket_multiplier);
		$this->form_validation->preset_value('sponsor_id', $race->race_sponsor_id);
		
			list($start_date, $start_time) = explode(' ', $race->race_start_time);
			list($reg_date, $reg_time) = explode(' ',$race->race_registration_time);
		
		$this->form_validation->preset_value('start_time', $start_time);
		$this->form_validation->preset_value('registration_time', $reg_time);	
	
		$this->load->view('race/admin/add');			

	}
	
	public function del($race_id){
		$this->load->model('series_race/series_race_model');
		$this->load->model('result/result_model');

		$this->race_model->deleteById($race_id);
		$this->series_race_model->deleteByRaceId($race_id);
		$this->result_model->deleteByRaceId($race_id);
		
		$data = array('error' => false);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
	}
	
	public function setstatus(){
		$race_id = $this->input->get('race_id');
		$status_id = $this->input->get('status_id');
		
		$this->race_model->updateStatusByRaceId($status_id, $race_id);
		$data = array('error' => false);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );

	}

	public function settings(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$config = array(
		               array(
		                     'field'   => 'point_bracket', 
		                     'label'   => 'Default point bracket', 
		                     'rules'   => 'required'
		                  ),
		               array(
		                     'field'   => 'race_status_id', 
		                     'label'   => 'Race status id', 
		                     'rules'   => 'required'
		                  )
		            );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->preset_value('race_default_uses_point_bracket', setting('race_default_uses_point_bracket'));
			
			$this->load->model('race_type/race_type_model');
			$race_types = $this->race_type_model->loadAll();
			
			$this->load->view('race/admin/settings', array('race_types'=>$race_types));		

		}
		else
		{
			$this->setting_model->update('race_default_course_id', $this->input->post('course_id'));	
			$this->setting_model->update('race_default_laps', $this->input->post('race_default_laps'));
			$this->setting_model->update('race_default_uses_point_bracket', $this->input->post('point_bracket'));
			$this->setting_model->update('race_default_race_type_id', $this->input->post('race_type_id'));
			$this->setting_model->update('race_default_race_status_id', $this->input->post('race_status_id'));

			$this->session->set_flashdata('updated', 'Race defaults saved.');
			redirect("admin/race/settings");
		}		
	}
	
	public function createPlacingsByTime($race_id){
		$this->race_model->load($race_id);
		$this->load->model('result/result_model');
		
		// clear any placing results that already exist
		$this->result_model->dropResultsForRaceOfType($race_id, 3); // place is id 3
		
		// get a list of all the time results sorted by category, data
		$times = $this->result_model->getTimesForRace($race_id);
		//pr($times);
		
		$places = array();
		foreach($times as $i=>$rider){			
			$rider_category = $rider->result_rider_category_id;
			if(!isset($places[$rider_category])){ 
				// start the counter for this category group at first place
				$places[$rider_category] = 1; 
			}
				
			//echo 'create new result: rider_id:'. $rider->rider_id . ' for race: '. $race_id .' will get place:' . $places[$rider_category] ."\n";
			//$this->result_model->$result_id;
			$this->result_model->result_result_type_id = 3; // Place
			$this->result_model->result_rider_id = $rider->rider_id;
			$this->result_model->result_race_id = $race_id;
			$this->result_model->result_data = $places[$rider_category];
			$this->result_model->result_note = null;
			$this->result_model->result_rider_category_id = $rider->result_rider_category_id;
			$result_id = $this->result_model->save();
			
			// iterate the places holder
			$places[$rider_category]++;
		}
		$this->output->set_content_type('application/json')->set_output( json_encode(array('error'=>false) ) );
	}
}
