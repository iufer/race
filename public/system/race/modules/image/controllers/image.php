<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends RA_Controller {

	public $loginRequired = true;	

	protected $_root;
	protected $_base;
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('image_model');
		$this->load->config('image');

		$this->_root = $this->config->item('image_upload_root');
		$this->_base = $this->config->item('image_uri_root');
	}
	
	public function upload($name, $path = false){
		if(isset($_FILES[$name])){
			
			if($_FILES[$name]['error'] === UPLOAD_ERR_OK){			
				$uploadfile = $this->_root . basename($_FILES[ $name ]['name']);		
		
				if(move_uploaded_file($_FILES[ $name ]['tmp_name'], $uploadfile)) {
					$this->image_model->image_name = basename($_FILES[ $name ]['name']);
					$this->image_model->image_path = site_url($this->_base . $this->image_model->image_name);
					$this->image_model->image_size = basename($_FILES[ $name ]['size']);
					$this->image_model->image_type = basename($_FILES[ $name ]['type']);
			
					$image_id = $this->image_model->save();							
					return $image_id;
				}
				else {
					// move file failed
					//echo 'upload move failed';
					return false;
				}
			}
			else {
				// upload failed
				//echo 'upload failed with error '. $_FILES[$name]['error'];
				return false;
			}
		}
		else {
			// nothing to upload
			//echo 'no upload file provided';
			return false;
		}
	}
}
	