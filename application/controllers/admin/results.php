<?php
class Results extends Admin_Controller
{    
    function __construct() {
        parent::__construct();
        $this->load->model('result_m');
        $this->load->model('quiz_m');
    }

    function _remap($method, $args) {
        if(method_exists($this, $method)) {
            if(isset($args[0])) {
                $this->$method($args[0]);
            } else {
                $this->$method();
            }
        } else {
            $this->index($method, $args);
        }
    }

    public function index($q_id = NULL) {
    	if($q_id == NULL) {
            $this->data['quiz'] = $this->quiz_m->get_by(array('prize_money !=' => 0, 'date <=' => date('Y-m-d')));  
			$this->load->view('admin/results/home', $this->data);
    	} else {
    		$this->data['quiz'] = $this->quiz_m->get($q_id);
    		count($this->data['quiz']) || show_404();
            if(($this->data['quiz']->prize_money == 0) || ($this->data['quiz']->date > date('Y-m-d')) || ($this->data['quiz']->is_result_published == 0) ) { show_404(); }

            $this->data['result'] = $this->result_m->get_by(array('quiz_id' => $q_id));

            $this->load->model('user_m');

            $this->data['user'][0] = 0;
            foreach ($this->data['result'] as $r) {
                $this->data['user'][$r->user_id] = $this->user_m->get($r->user_id);
            }
            unset($this->data['user'][0]);

            $this->load->model('userquiz_m');
            $this->data['quiz_enrolled'] = $this->userquiz_m->enrolled_users($q_id);

            $this->load->view('admin/results/single', $this->data);
    	}
    }

    public function publish_result($q_id) {
    	if($q_id) {
    		$this->data['quiz'] = $this->quiz_m->get_by(array('prize_money !=' => 0, 'id' => $q_id), TRUE);
    		count($this->data['quiz']) || show_404();

            $end_time = new DateTime($this->data['quiz']->date.' '.$this->data['quiz']->end_time);
            $now_time = new DateTime(date('Y-m-d H:i:s'));

            if($now_time <= $end_time) {
                echo 'The Quiz you opted for hasn\'t finished yet.';
                sleep(3);
                redirect('admin/results');
            }

            $entry = $this->result_m->get_by(array('quiz_id' => $q_id));

            if(count($entry) > 1) {
                $this->result_m->rank($q_id);
            }

            $post['is_result_published'] = 1;
            $this->quiz_m->save($post, $q_id);

            redirect('admin/results/'.$q_id, 'refresh');
    	} else {
    		show_404();
    	}
    }
}
?>