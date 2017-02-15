<?php
class Faq extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['current_page'] = 'FAQ';
        $this->data['title'] = 'FAQ | '.$this->data['site_title'];
		
		$this->load->view('faq', $this->data);
    }
}
?>