<?php
class Admin_Controller extends MY_Controller
{    
    function __construct() {
        parent::__construct();

		//2 things must be checked. whether the user is logged in or not. if not sent them to the admin login page
        //if logged in, then check whether the user is admin. if not show error and redirect to homepage 

        if (!$this->ion_auth->logged_in()) {
			redirect('user/login', 'refresh');
		} elseif (!$this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
			sleep(5);
			redirect('','refresh');
		}
		
		$this->data['session'] = $this->session->all_userdata();
    }
}
?>