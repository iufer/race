<?php

// http://codeigniter.com/forums/viewthread/157161/#758740

class RA_Form_validation extends CI_Form_validation {

    function set_post_validation_error($field, $message)
    {
        if(! isset($this->_field_data[$field]))
        {
            $this->_field_data[$field]['postdata'] = '';
        }
        
        $this->_field_data[$field]['error'] = $message;
        
        if ( ! isset($this->_error_array[$field]))
        {
            $this->_error_array[$field] = $message;
        }
    }
       

 	function preset_value($field, $value){
		$this->_field_data[$field]['postdata'] = $value;
	}
} 