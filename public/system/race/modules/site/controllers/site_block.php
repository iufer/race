<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_block extends MX_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function stats(){

		$query = "select t.time, p.points, m.miles, c.courses, r.scheduled_races, ri.riders, rl.laps, s.series, tt.tt, pr.past_races
				from (select sum(result_data) as 'points' from result where result_result_type_id in (1,5)) as p, 
				(select sum(result_data) as 'time' from result where result_result_type_id = 2) as t, 
				(select sum(course_miles) as 'miles' from race join course on course.course_id = race.race_course_id) as m, 
				(select count(course_id) as 'courses' from course) as c, 
				(select count(race_id) as 'scheduled_races' from race where race_start_time > NOW() and race_race_status_id = 2) as r, 
				(select count(rider_id) as 'riders' from rider) as ri, 
				(select sum(race_laps) as 'laps' from race where race_start_time < NOW() and race_race_status_id = 2) as rl, 
				(select count(series_id) as 'series' from series) as s, 
				(select count(race_id) as 'tt' from race where `race_race_type_id` in (1,2)) as tt, 
				(select count(race_id) as 'past_races' from race where race_start_time < NOW()) as pr";
					
		$query = $this->db->query($query);
		$data = $query->row();
		
		return $this->load->view('block/stats', array('data'=>$data), true);
	}
	
	public function shareList(){
		$data = array(
			'twitter' => setting('site_share_twitter'),
			'facebook' => setting('site_share_facebook')
		);			
		return $this->load->view('block/share_list', $data, true);
	}
	
	public function menu($page_title = false) {
		$this->load->config('site');
		
		$menu = $this->config->item('site_nav');
		return $this->load->view('site/block/menu', array('menu'=>$menu), true);
	}	
	
	public function menu_admin($page_title = false) {
		$this->load->helper('site');
		$this->load->config('site');

		$menu = $this->config->item('site_admin_nav');
		return $this->load->view('site/block/menu_admin', array('menu'=>$menu), true);
	}	
	
	public function sitemap() {
		$this->load->config('site');		
		$menu = $this->config->item('site_nav');
		return $this->load->view('site/block/sitemap', array('menu'=>$menu), true);
	}	
}