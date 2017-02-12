<?php
class MY_Controller extends CI_Controller
{
	public $data = array();

    function __construct() {
        
        parent::__construct();

        $this->load->library('ion_auth');

		//not used anywhere. move to front end controller if its needed there
		$this->load->helper('date');

		//loaded in auth controller
       	$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

    }
}
?>