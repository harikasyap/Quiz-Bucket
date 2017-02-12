<?php
class Faq extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['current_page'] = 'FAQ';
        $this->data['title'] = 'FAQ | Quiz Bucket';
		
		$this->load->view('faq', $this->data);
    }
}
?>