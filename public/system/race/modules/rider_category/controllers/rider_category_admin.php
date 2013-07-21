<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rider_category_admin extends RA_Controller {

	public $loginRequired = true;	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('rider_category/rider_category_model');
	}
	
	public function index(){
		echo "rider category admin";
	}
	
	public function add(){
		$rider_category_name = $this->input->post('rider_category_name');
		$this->rider_category_model->rider_category_name = $rider_category_name;
		$rider_category_id = $this->rider_category_model->save();
		
		if($rider_category_id === false){
			$data = array('error'=>true);
		}
		else {
			$data = array(
				'id'=> $rider_category_id, 
				'name'=> ucwords($rider_category_name), 
				'order'=>$this->rider_category_model->rider_category_order
			);
		}
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
	}
	
	public function save($rider_category_id) {		
		$newname = $this->input->get('name');
		
		$this->rider_category_model->rider_category_id = $rider_category_id;
		$this->rider_category_model->rider_category_name = $newname;
		$success = $this->rider_category_model->update();		
		
		$data = array(
			'rider_category_name' => $newname,
			'rider_category_id' => $rider_category_id
		);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
	}
	
	public function del($rider_category_id, $replace_with_category_id){
		//pr($rider_category_id);
		//pr($replace_with_category_id);
		
		// validate that the replacement_id is valid
		
		// find all riders and results with this category_id and update with the new id
		$this->load->model('result/result_model');
		$this->result_model->swapRiderCategoryId($rider_category_id, $replace_with_category_id);
		// result.result_rider_category_id
		
		$this->load->model('rider/rider_model');
		$this->rider_model->swapRiderCategoryId($rider_category_id, $replace_with_category_id);
		// rider.rider_rider_category_id
		
		// delete the rider_category_id
		$this->rider_category_model->deleteById($rider_category_id);
		
		$data = array('id' => $rider_category_id, 'replaced'=>$replace_with_category_id);
		$this->output->set_content_type('application/json')->set_output( json_encode($data) );
		//if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
	}
	
	public function listing(){
		$omit_id = $this->input->get('omit');
		$data = $this->rider_category_model->listAll();
		if(isset($data[$omit_id])){
			unset($data[$omit_id]);
		}
		$out = array();
		foreach($data as $id=>$name){
			$out[] = array('id'=>$id, 'name'=>$name);
		}
		$this->output->set_content_type('application/json')->set_output( json_encode($out) );
	}
}