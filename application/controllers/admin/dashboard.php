<?php
class Dashboard extends Admin_Controller
{    
    function __construct() {
        parent::__construct();
    }

    public function index() {
        //checks if its first time or not (for displaying message)
        if($this->session->userdata('first') === FALSE) {
            $this->session->set_userdata(array('first' => 'true'));
        } else {
            $this->session->set_userdata(array('first' => 'false'));
        }

        $this->data['session'] = $this->session->all_userdata();

        $this->load->model('quiz_m');
        $this->data['recent_quiz'] = $this->quiz_m->get_recent();

        $this->load->view('admin/dashboard', $this->data);
    }


    /*Whether needed or not??*/

    public function login() {
        var_dump('admin login page');
    }

    public function logout() {
        var_dump('admin login page');
    }

}
?>