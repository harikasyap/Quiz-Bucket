<?php 
class Quiz extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('quiz_m');
    }

    function _remap($method, $args) {
        if(method_exists($this, $method)) {
            //$this->$method($args);
            if(isset($args[0])) {
                $this->$method($args[0]);
            } else {
                $this->$method();
            }
        } else {
            $this->index($method, $args);
        }
    }

    public function index($id = NULL) {
        if ($id == NULL) {
            $this->load->view('admin/quiz/home', $this->data);          
        }
        else {

            $this->data['quiz'] = $this->quiz_m->get($id);
            count($this->data['quiz']) || show_404();

            $this->load->model('ques_m');
            $this->data['question'] = $this->ques_m->get_by(array('quiz_id' => $id));

            foreach($this->data['question'] as $q) {
                $this->data['option1'][$q->id]= $this->ques_m->hash($q->option1);
                $this->data['option2'][$q->id]= $this->ques_m->hash($q->option2);
                $this->data['option3'][$q->id]= $this->ques_m->hash($q->option3);
                $this->data['option4'][$q->id]= $this->ques_m->hash($q->option4);
            }

            $this->load->model('userquiz_m');
            $this->data['quiz_enrolled'] = $this->userquiz_m->enrolled_users($this->data['quiz']->id);

            $this->load->view('admin/quiz/single', $this->data);
        }
    }

    public function edit ($id = NULL) {

        //load Instamojo library
        require APPPATH.'libraries/Instamojo.php';

        //If $id is passed, then we check whether any quiz with that id is present. If not we show a 404 error page
        //If $id is not passed, we create a new blank quiz class

        if ($id) {
            $this->data['quiz'] = $this->quiz_m->get($id);
            count($this->data['quiz']) || show_404();
        }
        else {
            $this->data['quiz'] = $this->quiz_m->get_new();
        }

        $rules = $this->quiz_m->rules;
        $this->form_validation->set_rules($rules);
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong>', '</div>');

        //If form validation runs, page is redirected
        //If form validation fails, it means values entered are not valid, so again the same view is loaded again

        if ($this->form_validation->run() == TRUE) {
            $post = $this->quiz_m->array_from_post(array(
                'title',
                'slug',
                'description',
                'date',
                'start_time',
                'end_time',
                'prize_money',
                'cost',
                'active'
            ));

            //Set the time stamp value

            $post['time_stamp'] = date('Y-m-d H:i:s');

            //Set the active field

            $post['active'] = ($post['active'])? 1 : 0;

            //slug is made to lower case

            $post['slug'] = strtolower($post['slug']);

            //If $id is set it means, it is an edit. So we need to redirect back to the quiz view
            //If $id is null means, it is a new entry. So we redirect to the question page

            if($id) {
                $this->quiz_m->save($post, $id);

                if($post['cost']!= 0) {
                  /*  $im = new Instamojo('c81f3dfa4a147386509ad12a94ff57da', '6a963d9d6a1e29921738c950d6daf3f9');

                    $response = $im->linkEdit('slug', array(                //slug to be set
                        'title' => $post['title'],
                        'description' => $post['description'],
                        'base_price' => $post['cost'],
                        'currency' => 'INR',
                        'start_date' => 'YYYY-MM-DD HH:mm', 
                        'end_date' => 'YYYY-MM-DD HH:mm',
                        'timezone' => 'Asia/Kolkata'
                        'redirect_url' => sit_url('enroll/')            //to be set
                    ));                                                 //venue is required, i think

                    $r = json_decode($response);

                    if($r->success == false) {
                        show_error($r->message);
                    }
                    */
                }
                redirect('admin/quiz/'.$id);
            } else {
                $p_id = $this->quiz_m->save($post);

                if($post['cost'] != 0) {
                  /* $im = new Instamojo('c81f3dfa4a147386509ad12a94ff57da', '6a963d9d6a1e29921738c950d6daf3f9');

                    $response = $im->linkCreate(array(
                        'title' => $post['title'],
                        'description' => $post['description'],
                        'base_price' => $post['cost'],
                        'currency' => 'INR',
                        'start_date' => 'YYYY-MM-DD HH:mm', 
                        'end_date' => 'YYYY-MM-DD HH:mm',
                        'timezone' => 'Asia/Kolkata',
                        'redirect_url' => sit_url('enroll/')            //to be set
                    ));                                                 //venue is required, i think

                    $r = json_decode($response);

                    if($r->success == false) {
                        show_error($r->message);
                    }
                    */
                }
                redirect('admin/question/edit/'.$p_id);
            }
            
        }
        
        $this->load->view('admin/quiz/edit', $this->data);

    }

    public function paid() {
        $this->data['quiz'] = $this->quiz_m->get_by(array('date >=' => date('Y-m-d'), 'prize_money !=' => 0));

        if(!empty($this->data['quiz'])) {
            $this->load->model('userquiz_m');

            foreach ($this->data['quiz'] as $quz) {
                $this->data['quiz_enrolled'][$quz->id] = $this->userquiz_m->enrolled_users($quz->id);
            }            
        }

        $this->load->view('admin/quiz/paid', $this->data);
    }

    public function free() {
        $this->data['quiz'] = $this->quiz_m->get_by(array('prize_money' => 0));

        if(!empty($this->data['quiz'])) {
            $this->load->model('ques_m');

            foreach ($this->data['quiz'] as $quz) {
                $this->data['quiz_total'][$quz->id] = $this->ques_m->total_questions($quz->id);
            }            
        }

        $this->load->view('admin/quiz/free', $this->data);    
    }

    public function archive() {
        $this->data['quiz'] = $this->quiz_m->get_by(array('date <' => date('Y-m-d'), 'prize_money !=' => 0));

        if(!empty($this->data['quiz'])) {
            $this->load->model('userquiz_m');

            foreach ($this->data['quiz'] as $quz) {
                $this->data['quiz_enrolled'][$quz->id] = $this->userquiz_m->enrolled_users($quz->id);
            }            
        }

        $this->load->view('admin/quiz/archive', $this->data);    
    }

    public function delete ($id) {        
        $this->quiz_m->delete($id);
        
        $this->load->model('ques_m');
        $this->ques_m->delete_quest($id);
        
        redirect('admin/quiz', 'redirect');
    }

    public function change_active($id) {
        $this->data['quiz'] = $this->quiz_m->get($id);

        $post['active'] = ($this->data['quiz']->active == 1)? 0: 1;
        $this->quiz_m->save($post, $id);

        redirect('admin/quiz/'.$id);
    }

    //Dont validate if slug already exists
    //Unless it's the slug for the current quiz

    public function _unique_slug ($str) {

        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        ! $id || $this->db->where('id !=', $id);
        $quiz = $this->quiz_m->get();

        if (count($quiz)) {
            $this->form_validation->set_message('_unique_slug', 'The %s field should be unique.');
            return FALSE;
        }
        
        return TRUE;
    }

    //Checks if the entered date is backward than today

    public function _is_lt_today ($str) {

        if ($this->input->post('date') < date('Y-m-d')) {
            $this->form_validation->set_message('_is_lt_today', 'The %s field must be forward than today\'s date.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Checks if the start time is greater than end time

    public function _is_start_gt_end ($str) {

        if ($this->input->post('start_time') > $this->input->post('end_time')) {
            $this->form_validation->set_message('_is_start_gt_end', 'The From field must be less than the To field.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
}
?>