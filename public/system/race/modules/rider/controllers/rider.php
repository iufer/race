<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rider extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('rider_model');
	}
	
	public function index($rider_category_id = 0, $from = 0) {
		$this->load->helper('url');	
		$this->load->helper('html');
		$this->load->library('pagination');
		
		$span = 30;
		$rider_category = false;
		
		$riders = $this->rider_model->loadAllInRangeInCategory($from, $span, $rider_category_id);
		if($rider_category_id > 0) {
			$riders_count = $this->rider_model->countAllInCategory($rider_category_id);
			$this->load->model('rider_category/rider_category_model');
			$rider_category = $this->rider_category_model->load($rider_category_id);
		}
		else {
			$riders_count = $this->rider_model->countAll();
		}
		
		$this->pagination->initialize( 
							array(
								'base_url'=> site_url('rider/index/'. $rider_category_id .'/'),
								'total_rows'=> $riders_count,
								'per_page'=> $span,
								'uri_segment'=> 4,
								'num_links'=> 10,
								'full_tag_open' => '<div class="pagination"><ul>',
								'full_tag_close' => '</ul></div>',
								'first_link' => 'First',
								'first_tag_open' => '<li>',
								'first_tag_close' => '</li>',								
								'last_link' => 'Last',
								'last_tag_open' => '<li>',
								'last_tag_close' => '</li>',
								'next_link' => 'Next',
								'next_tag_open' => '<li>',
								'next_tag_close' => '</li>',								
								'prev_link' => 'Previous',
								'prev_tag_open' => '<li>',
								'prev_tag_close' => '</li>',
								'cur_tag_open' => '<li class="active"><a>',
								'cur_tag_close' => '</a></li>',
								'num_tag_open' => '<li>',
								'num_tag_close' => '</li>'
								)
							);
		
		$count_found = count($riders);						
		$showing = ($count_found > $riders_count) ? "Showing all $riders_count riders" : "Showing $count_found out of $riders_count riders";
		
		$this->load->view('rider/index', array('riders'=>$riders, 'showing'=>$showing, 'rider_category'=>$rider_category));
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);		
	}
	
	public function view($rider_id, $from = 0){
		$this->load->model('result/result_model');
		$rider = $this->rider_model->load($rider_id);

		if($rider === false){
			show_404();
		}
		else {
		
			// +1 the profile view for this rider
			$this->rider_model->profileView($rider_id);

			$this->load->view('rider/view', array('rider'=>$rider, 'pagination_from'=>$from));
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
		}
	}
	
	public function search(){
		$term = $this->input->get('term');
		$data = $this->rider_model->listBySearch($term);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
}