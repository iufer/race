<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_admin extends RA_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user/user_model');
	}

	public function index(){
		if($this->user_model->isLoggedIn()){
			$this->load->view('admin/index');
		}
		else {
			redirect('site/login');
		}
	}
	
	public function logout(){
		$this->user_model->setLoggedOut();
		redirect('/');
	}
	
	// admin/site/upload
	public function upload() {
		$files = $_FILES['userfile'];
		
		foreach($files['name'] as $i=>$file_name){
			$type = $files['type'][$i];
			$tmp_name = $files['tmp_name'][$i];
			$error = $files['error'][$i];
			$size = $files['size'][$i];
			
			$tmpdir = FCPATH .'tmp/';
			
			move_uploaded_file($tmp_name, $tmpdir . $file_name);
			$data[] = array('name'=>$file_name);
		}

		echo_json($data);		
	}
	
	public function settings() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$config = array(
		               array(
		                     'field'   => 'site_name', 
		                     'label'   => 'Site Name', 
		                     'rules'   => 'required'
		                  ),
		               array(
		                     'field'   => 'site_description', 
		                     'label'   => 'Site description', 
		                     'rules'   => 'required'
		                  ),
		               array(
		                     'field'   => 'site_city', 
		                     'label'   => 'Site city', 
		                     'rules'   => 'required'
		                  ),   
		               array(
		                     'field'   => 'site_state', 
		                     'label'   => 'Site state', 
		                     'rules'   => 'required'
		                  )
		            );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->preset_value('site_name', setting('site_name'));
			$this->form_validation->preset_value('site_description', setting('site_description'));
			$this->form_validation->preset_value('site_city', setting('site_city'));
			$this->form_validation->preset_value('site_state', setting('site_state'));
			$this->load->view('site/admin/settings');		

		}
		else
		{
			$this->setting_model->update('site_domain', $this->input->post('site_domain'));	
			$this->setting_model->update('site_name', $this->input->post('site_name'));	
			$this->setting_model->update('site_description', $this->input->post('site_description'));
			$this->setting_model->update('site_city', $this->input->post('site_city'));				
			$this->setting_model->update('site_state', $this->input->post('site_state'));				
			$this->setting_model->update('site_about', $this->input->post('site_about'));				
			$this->setting_model->update('site_copyright', $this->input->post('site_copyright'));
			$this->setting_model->update('site_google_analytics_account', $this->input->post('site_google_analytics_account'));	
			
			$this->setting_model->update('site_share_flickr_user', $this->input->post('site_share_flickr_user'));								
			$this->setting_model->update('site_share_twitter', $this->input->post('site_share_twitter'));
			$this->setting_model->update('site_share_facebook', $this->input->post('site_share_facebook'));				
			
			$this->setting_model->update('color_a', $this->input->post('color_a'));
			$this->setting_model->update('color_b', $this->input->post('color_b'));
			$this->setting_model->update('color_c', $this->input->post('color_c'));
			$this->setting_model->update('color_d', $this->input->post('color_d'));
			
			$this->setting_model->update('cms_race_sidebar', $this->input->post('cms_race_sidebar'));
			$this->setting_model->update('cms_course_sidebar', $this->input->post('cms_course_sidebar'));
			$this->setting_model->update('cms_series_sidebar', $this->input->post('cms_series_sidebar'));
			$this->setting_model->update('cms_rider_sidebar', $this->input->post('cms_rider_sidebar'));
												
			$this->session->set_flashdata('updated', 'Site settings saved.');
			redirect("admin/site/settings");
		}		
	}

	public function export(){
		$this->load->dbutil();
		$filename = 'raceapp_db_'. date('Y_m_d') .".zip";
		$prefs = array(
		                'tables'      => array('race'),  // export all tables
		                'ignore'      => array(),	// List of tables to omit from the backup
		                'format'      => 'zip',             // gzip, zip, txt
		                'filename'    => $filename,    // File name - NEEDED ONLY WITH ZIP FILES
		                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
		                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
		                'newline'     => "\n"               // Newline character used in backup file
		              );
		
		$backup =& $this->dbutil->backup($prefs);
		$this->load->helper('download');
		force_download($filename, $backup);
	}
}