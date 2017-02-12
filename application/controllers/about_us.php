<?php
class About_Us extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['current_page'] = 'About Us';
        $this->data['title'] = 'About Us | Quiz Bucket';
		
		$this->load->view('about_us', $this->data);
    }
}
?>