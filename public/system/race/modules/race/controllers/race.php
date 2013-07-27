<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race extends RA_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('race_model');
	}
	
	public function index($from = 0, $race_type_id = 0) {		
		$this->load->helper('html');
		$this->load->library('pagination');
		
		$races = $this->race_model->loadAllFuture(true, $race_type_id);
		
		$span = 20;		
		$past_races = $this->race_model->loadAllPastInRangeByType(true, $from, $span, $race_type_id);

		if($race_type_id > 0) {
			$total_past_races = $this->race_model->countAllPastInType(true, $race_type_id);
			$this->load->model('race_type/race_type_model');
			$race_type = $this->race_type_model->load( $race_type_id );
		}
		else {
			$total_past_races = $this->race_model->countPastRaces();
			$race_type = false;
		}

		$showing = "Showing ". count($past_races) ." out of ". $total_past_races ." past races";
		$this->pagination->initialize( array(
								'base_url'=> site_url('race/index'),
								'total_rows'=> $total_past_races,
								'per_page'=> $span,
								'full_tag_open' => '<div class="pagination"><ul>',
								'full_tag_close'=>'</ul></div>',
								'next_link'=>'Next',
								'next_tag_open'=>'<li>',
								'next_tag_close'=>'</li>',
								'prev_link'=>'Previous',
								'prev_tag_open'=>'<li>',
								'prev_tag_close'=>'</li>',
								'first_tag_open'=>'<li>',
								'first_tag_close'=>'</li>',
								'last_link'=>'Last',
								'last_tag_open'=>'<li>',
								'last_tag_close'=>'</li>',
								'cur_tag_open'=>'<li class="active"><a>',
								'cur_tag_close'=>'</a></li>',
								'num_tag_open'=>'<li>',
								'num_tag_close'=>'</li>'));
		
		$this->load->view('race/index', array('races'=>$races, 'past_races'=>$past_races, 'showing' => $showing, 'race_type'=>$race_type));
		if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);		
	}
	
	public function view($url = false){
		$this->load->helper('form');
		$this->load->helper('course/course');
		
		$this->load->model('result_type/result_type_model');

		$race = $this->race_model->loadByUrl($url);
		if($race == false){
			show_404();
		}
		else {
			$this->load->view('race/view', array('race'=>$race));		
			if(ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);		
		}
	}	
	
	public function willAttend($race_id){
		$this->load->library('session');
		$attending = $this->session->userdata('races_attending');
		
		if(is_array($attending) and in_array($race_id, $attending) ){
			$data = array('error'=>'already attending');
			$this->output->set_content_type('application/json')->set_output( json_encode($data) );
			return true;
		}
		else {
			$data = array('race_will_attend_count'=> $this->race_model->incrementWillAttend($race_id) );						
			// set the session stuffs here
			if(is_array($attending)) { $attending[] = $race_id; }
			else { $attending = array($race_id); }
		
			$this->session->set_userdata('races_attending', $attending);
			$this->output->set_content_type('application/json')->set_output( json_encode($data) );
			return true;
		}
	}
	
	public function rss(){
		$this->load->helper('xml');
		$this->load->helper('text');
		
		$data = array(
			'feed_name'=> setting('site_name'),
			'encoding'=> 'utf-8',
			'feed_url'=> site_url("race/rss"),
			'page_description'=> "Race Feed",
			'page_language'=> 'en-en',
			'creator_email'=> '',
			'posts'=> $this->race_model->loadAllFuture(true)
		);
		
		$this->output->set_content_type('text/xml');
		$this->load->view('race/rss', $data);
		
	}

	public function calendar($month = 0){
		$this->load->helper('text');
		
		$races = $this->race_model->loadAllThisMonth($month);
		$tpl = file_get_contents(FCPATH .'system'.DC.'race'.DC.'modules'.DC.'race'.DC.'views'.DC.'calendar.tpl');			
		
		$this->load->library('calendar', array('template' => $tpl, 'day_type'=>'long'));

		$dates = array();
		foreach($races as $i=>$race){
			$d = date('j', mysql_to_unix($race->race_start_time));
			if(!isset($dates[$d])){
				$dates[$d] = array();
			}
			switch($race->race_type_id){
				case 1: $type_class = 'bg-blue'; break;
				case 2: $type_class = 'bg-green'; break;
				case 3: $type_class = 'bg-yellow'; break;
				case 4: $type_class = 'bg-red'; break;
				case 5: $type_class = 'bg-purple'; break;
				case 6: $type_class = 'bg-gray'; break;
				case 7: $type_class = 'bg-grayDark'; break;	
				default: $type_class = null;
			};
			
			$dates[$d][] = array(
				'link_list' => "<li>". anchor("race/{$race->race_url}", word_limiter($race->race_name, 5) ."</li>" ),
				'class'=> 'badge_'. $race->race_type_type,
				'type' => $race->race_type_type,
				'type_class' => $type_class
			);
			//array_push($dates[ $d ], $r);
		}
		//pr($dates);
		
		$setdate = mktime(0, 0, 0, date('m')+$month, 1, date('Y'));
		$data = array(
			'month' => date('F', $setdate),
			'calendar' => $this->calendar->generate(date('Y', $setdate), date('m', $setdate), $dates)
		);
		$this->load->view('race/calendar', $data);
		// if(ENVIRONMENT != 'production') $this->output->enable_profiler(TRUE);
	}
}
