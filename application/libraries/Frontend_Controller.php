<?php
class Frontend_Controller extends MY_Controller
{
	function __construct() {
		parent::__construct();

        $this->data['site_title'] = "Quiz Bucket";        
		$this->data['title'] = 'Quiz Bucket | Play Online Quiz and Win Money';
    	$this->data['current_page'] = '';

    	if($this->ion_auth->logged_in()) {
    		$this->data['user_data']['id'] = $this->session->userdata('user_id');
    		$this->data['user_data']['is_admin'] = ($this->ion_auth->is_admin())? 'true' : 'false';
    		$this->data['user_data']['email'] = $this->session->userdata('email');
    		$this->data['user_data']['name'] = ucwords($this->session->userdata('username'));
    	}
	}
}
?>