<?php

class RA_Controller extends MX_Controller {

	protected $loginRequired = false;
	
    function __construct() {
        parent::__construct();

        // bootstrap the site setttings
		$this->load->model('setting/setting_model');

		if($this->loginRequired){
			$this->load->model('user/user_model');
			if(! $this->user_model->isLoggedIn() ){				
				//show_404();
				redirect('site/login');
			}
		}		
    }

	
}