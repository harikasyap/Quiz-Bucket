<?php
class Enroll extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
        $this->load->model('quiz_m');
        $this->load->model('userquiz_m');
        $this->load->helper('obfuscate');
        
        if(!$this->ion_auth->logged_in()) {
            redirect('user/login');
        }
    }

    //check the need for this here
    //allows custom URI routing
    function _remap($params) {

        $para = $this->uri->segment(2);

        $flag = FALSE;
        $functions = array('payment');
        
        foreach ($functions as $fnc) {
            if($para == $fnc) {
                $flag = TRUE;
                $this->$fnc($this->uri->segment(3));
                break;
            }
        }

        if($flag == FALSE) {
            $this->index($para);            
        }

    }

    public function index($q_id = NULL) {

        if($q_id == NULL) {
            show_404();
        }
        
        //check if quiz id is valid and it's not a free quiz in which case we dont need to enroll to play
    	$this->data['quiz'] = $this->quiz_m->get_by(array('id' => decrypt_id($q_id), 'prize_money >' => 0), TRUE);
        count($this->data['quiz']) || show_404();

        //if enrolled redirect to quiz view page
        if($this->userquiz_m->is_enrolled(array('quiz_id' => $this->data['quiz']->id, 'user_id' => $this->session->userdata['user_id']))) {
        	redirect('quiz/'.$this->data['quiz']->slug);
        } else {
           	$now_time = new DateTime(date('Y-m-d H:i:s'));
        	$start_time = new DateTime($this->data['quiz']->date.' '.$this->data['quiz']->start_time);

            //if quiz is already started, enrollment cant be done
        	if($now_time >= $start_time) {
        		redirect('quiz/'.$this->data['quiz']->slug);
                //flash message must be set that quiz has already started and redirected to quiz view page
        	} else {
                //if sponsered quiz, simply enroll; else proceed to payment gateway to complete the buying process 
                if($this->data['quiz']->cost == 0) {
                    $enroll_data = array('quiz_id' => $this->data['quiz']->id, 'user_id' => $this->session->userdata('user_id'), 'date_time' => date('Y-m-d H:i:s'));
                    $this->userquiz_m->save($enroll_data);
                    redirect('quiz/'.$this->data['quiz']->slug);
                } else {
                    //proceed to payment gateway function
                    //redirect('payment');
                    print_r('payement gateway');
                }
            }
        }

    }

}
?>