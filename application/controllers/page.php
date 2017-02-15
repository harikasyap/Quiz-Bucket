<?php
class Page extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
    }

    public function index() {

        //upcoming quizzes
        $this->load->model('quiz_m');
        $this->data['quiz'] = $this->quiz_m->get_recent(6);

        //recent tags of question bank
        $this->load->model('tags_m');
        $this->data['tags'] = $this->tags_m->get_recent();

        //recent current affairs
    	$this->load->model('currentaffairs_m');
    	$this->data['current_affairs'] = $this->currentaffairs_m->get_recent();

    	$this->data['title'] = $this->data['site_title'].' | Play Online Quiz and Win Money';
    	$this->data['current_page'] = 'Home';
    	$this->load->view('home', $this->data);
    }

    public function error_404() {
        $this->output->set_status_header('404');
        $this->data['title'] = 'Oops! Page not found | '.$this->data['site_title'];
        $this->load->view('404_page', $this->data);
    }
}
?>