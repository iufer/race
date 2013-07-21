<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_admin extends RA_Controller {

	public $loginRequired = true;

	public function __construct(){
		parent::__construct();
		$this->load->model('result/result_model');
	}

	public function add() {
		//sleep(5);
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->input->post('result_scope_global') == 1){
			$this->addForAllRiders();
			return true;
		}

		if($this->form_validation->run('result/add') == FALSE) {					
			$data = array('error'=> validation_errors() );
			$this->output->set_content_type('application/json')->set_output( json_encode($data) );				
		}
		else {
						
			$rider_id = $this->input->post('rider_id');
			$rider_category_id = $this->input->post('rider_category_id');
			$rider_name = $this->input->post('rider_name');

			$this->load->model('rider/rider_model');
			
			// Create and load a new rider
			if($rider_id == ''){
				// hold on... lets see if this guy exists or not
				$rider_id = $this->rider_model->riderExistsByName( $rider_name );
				
				if( ! $rider_id){
					// ok so we're sure they dont exist
					$this->rider_model->rider_rider_category_id = $rider_category_id;
					$this->rider_model->rider_name = $rider_name;
					$rider_id = $this->rider_model->save();
				}
				$rider = $this->rider_model->get($rider_id);			
			}
			else {
				// Load our rider		
				$rider = $this->rider_model->get($rider_id);
			
				// Update rider category
				$rider->rider_rider_category_id = $rider_category_id;
				$this->rider_model->update($rider);
			}
			
			// Save our result
			// we have an array of result_type_id[], data[], note[]
			$result_type_ids = $this->input->post('result_type_id');
			$datum = $this->input->post('data');
			$notes = $this->input->post('note');
			
			foreach($datum as $i=>$data){
				if($data == '' || $data === 0) continue;
				$this->result_model->result_rider_id = $rider->rider_id;			
				$this->result_model->result_result_type_id = $result_type_ids[$i];
				$this->result_model->result_race_id = $this->input->post('race_id');
				$this->result_model->result_data = $data;
				$this->result_model->result_note = $notes[$i];
				$this->result_model->result_rider_category_id = $rider_category_id;
				$result_id = $this->result_model->save();
				//echo $this->db->last_query();				
			}
			
			$data = array('result_id'=>$result_id, 'rider_name'=>$rider->rider_name);
			$this->output->set_content_type('application/json')->set_output( json_encode($data) );				

		}	
	}
	
	public function edit($result_id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run('result/edit') == FALSE) {
			$this->load->model('result_type/result_type_model');
			$this->load->model('rider_category/rider_category_model');
								
			$result = $this->result_model->loadExtended($result_id);
			$result_types = $this->result_type_model->listAll();	
			$rider_categories = $this->rider_category_model->listAll();
					
			$data = array('result'=> $result, 'result_types'=>$result_types, 'rider_categories'=>$rider_categories, 'error'=> validation_errors() );
			$this->load->view('result/block/edit', $data);
		}
		else {

			// editable fields
			// result_type_id
			// result_data
			// result_note
			// rider_category_id
		

			$this->result_model->result_id = $result_id;
			$this->result_model->result_rider_category_id = $this->input->post('rider_category_id');
			$this->result_model->result_result_type_id = $this->input->post('result_type_id');
			$this->result_model->result_data = $this->input->post('data');
			$this->result_model->result_note = $this->input->post('note');

			$this->result_model->update();

			$data = array('result_id'=>$result_id);
			$this->output->set_content_type('application/json')->set_output( json_encode($data) );				
		}
	}
	
	public function addForAllRiders(){		
		
		$this->form_validation->set_rules('race_id', 'Race ID', 'required');
		
		if($this->form_validation->run() == FALSE) {					
			$data = array('error'=> validation_errors() );
			$this->output->set_content_type('application/json')->set_output( json_encode($data) );				
		}
		else {
			// get the list of the current riders with results for this race
			
			$race_id = $this->input->post('race_id');
			$result_data = $this->result_model->listRidersByRaceId($race_id);
			
			// foreach data item, add a result for each rider
			foreach($result_data as $rider){
				
				$rider_id = $rider->result_rider_id;
				$rider_category_id = $rider->result_rider_category_id;
				
				// Save our result
				// we have an array of result_type_id[], data[], note[]
				$result_type_ids = $this->input->post('result_type_id');
				$datum = $this->input->post('data');
				$notes = $this->input->post('note');

				foreach($datum as $i=>$data){
					if($data == '' || $data === 0) continue;
					$this->result_model->result_rider_id = $rider_id;			
					$this->result_model->result_result_type_id = $result_type_ids[$i];
					$this->result_model->result_race_id = $race_id;
					$this->result_model->result_data = $data;
					$this->result_model->result_note = $notes[$i];
					$this->result_model->result_rider_category_id = $rider_category_id;
					$result_id = $this->result_model->save();
									
				}				
			}
			
			$data = array('rider_name'=>'All Riders', 'error'=>false);
			$this->output->set_content_type('application/json')->set_output( json_encode($data) );			
						
		}
		
	}
	
	public function del($result_id){
		// remove a result ajaxy style
		$this->result_model->deleteById($result_id);
		$this->output->set_content_type('application/json')->set_output( json_encode(array('error'=>null)) );				
		
	}
	
	public function race($race_id){
		// load the block and echo it
		echo Modules::run('result/result_block/race_admin', $race_id);
	}
}