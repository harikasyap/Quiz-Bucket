<?php
class Quiz extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
        $this->load->model('quiz_m');
        $this->load->model('userquiz_m');
        $this->load->library('uri');
        $this->load->helper('obfuscate');
    }

    //allows custom URI routing
    function _remap($method) {

        $para = $this->uri->segment(2);

        $flag = FALSE;
        $functions = array('run', 'result', 'archive', 'free', 'result_save');
        
        foreach ($functions as $fnc) {
            if($para == $fnc) {
                $flag = TRUE;
                if($this->uri->segment(4)) {
                    $this->$fnc($this->uri->segment(3), $this->uri->segment(4));
                } else {
                    $this->$fnc($this->uri->segment(3));
                }
            }
        }

        if($flag == FALSE) {
            $this->index($para);            
        }

    }

    public function index($slug = NULL) {
         
        if($slug) {

            $this->data['quiz'] = $this->quiz_m->get_by(array('slug' => $slug, 'prize_money !=' => 0), TRUE);
            count($this->data['quiz']) || show_404();
            
            $start_time = new DateTime($this->data['quiz']->date.' '.$this->data['quiz']->start_time);
            $end_time = new DateTime($this->data['quiz']->date.' '.$this->data['quiz']->end_time);
            $now_time = new DateTime(date('Y-m-d H:i:s'));
            
            $this->data['interval'] = FALSE;
            $this->data['ended'] = FALSE;
            $this->data['started'] = FALSE;
            $this->data['enrolled'] = FALSE;

            if($this->ion_auth->logged_in()) {
                $where = array('user_id' => $this->session->userdata('user_id'), 'quiz_id' => $this->data['quiz']->id);
                $this->data['enrolled'] = $this->userquiz_m->is_enrolled($where);
            }

            //during quiz
            if($now_time >= $start_time && $now_time < $end_time) {
                $this->data['started'] = strtotime($end_time->format('Y-m-d H:i:s')) - strtotime($now_time->format('Y-m-d H:i:s'));
            }
            //after quiz
            elseif($now_time >= $end_time) {
                $this->data['ended'] = TRUE;
            }
            //before quiz
            else {
                $this->data['interval'] = $now_time->diff($start_time);
            }

            $this->data['title'] = $this->data['quiz']->title.' | Quiz Bucket';
            $this->data['id_enc'] = encrypt_id($this->data['quiz']->id);
            $this->load->view('quiz_single', $this->data);

        } else {
            $this->data['quiz'] = $this->quiz_m->get_by(array('active' => 1));

            $this->data['title'] = 'Quiz | Quiz Bucket';
            $this->data['current_page'] = 'Quiz';

            $this->load->view('quiz', $this->data);
        }

    }

    //show all paid quiz where pubdate < today & active = 0
    
    public function archive() {

        $this->data['quiz'] = $this->quiz_m->get_by(array('date <' => date('Y-m-d'), 'prize_money !=' => 0));
        $this->data['title'] = 'Quiz Archive | Quiz Bucket';

        $this->load->view('quiz_archive', $this->data);

    }

    public function run($slug = NULL, $id_enc = NULL) {

        if($slug == NULL || $id_enc == NULL) {
            show_404();
        } else {
            $id = decrypt_id($id_enc);

            $this->data['quiz'] = $this->quiz_m->get_by(array('id' => $id, 'slug' => $slug), TRUE);
            count($this->data['quiz']) || show_404();

            $this->ion_auth->logged_in() || redirect('user/login');
            $where = array('user_id' => $this->session->userdata('user_id'), 'quiz_id' => $this->data['quiz']->id);
            $this->userquiz_m->is_enrolled($where) || redirect('quiz/'.$this->data['quiz']->slug);
                       
            $start_time = new DateTime($this->data['quiz']->date.' '.$this->data['quiz']->start_time);
            $end_time = new DateTime($this->data['quiz']->date.' '.$this->data['quiz']->end_time);
            $now_time = new DateTime(date('Y-m-d H:i:s'));

            //quiz already ended
            if($now_time >= $end_time) {
                echo "The Quiz you opted has already expired.";            
            }
            //quiz hasn't started yet
            elseif($now_time < $start_time) {
                echo 'The Quiz you opted for hasn\'t started yet.';
                sleep(3);
                redirect('quiz/'.$quiz->slug);
            }
            else {
                $this->data['end_time'] = $end_time->format('Y-m-d H:i:s');
                $this->data['id_enc'] = $id_enc;

                //question are converted into array format
                $this->load->model('ques_m');
                $ques_n_optn = $this->ques_m->ques_to_array($this->data['quiz']->id);
                $this->data['questions'] = $ques_n_optn['questions'];
                $this->data['options'] = $ques_n_optn['options'];
                $this->data['selected'] = array_fill(0, count($this->data['questions']), '-1');
                $this->data['selected']['quiz_id'] = $id_enc;
                $this->data['checksum'] = encrypt_id($this->session->userdata('user_id'));
                $this->data['title'] = $this->data['quiz']->title.' | Quiz Bucket';

                $this->load->view('quiz_run', $this->data);
            }    
        }       

    }

    public function free($slug = NULL) {
        
        if($slug) {
            $this->data['quiz'] = $this->quiz_m->get_by(array('slug' => $slug, 'prize_money' => 0, 'cost' => 0, 'active' => 1), TRUE);
            count($this->data['quiz']) || show_404();

            $id_enc = encrypt_id($this->data['quiz']->id);

            $rules = $this->quiz_m->rules_free;
            $this->form_validation->set_rules($rules);

            //quiz run page
            if ($this->form_validation->run() == TRUE) {

                $this->ion_auth->logged_in() || redirect('user/login');

                //verification of checksum
                if($this->input->post('checksum') != $id_enc) {
                    show_error('Invalid submission!!!');
                }

                if($this->session->userdata('end_time') !== FALSE) {
                    $tm = substr($this->session->userdata('end_time'), 11, 8);
                    $t = new DateTime(date('Y-m-d').' '.$tm);
                    $n = new DateTime(date('Y-m-d H:i:s'));
                    if($n > $t) {
                        $this->session->unset_userdata('start_time');
                        $this->session->unset_userdata('end_time');
                    }
                }

                //checks if start_time is set in session. if set, it means quiz is in progress
                if( ($this->session->userdata('start_time') !== FALSE) && ($this->session->userdata('end_time') !== FALSE) ) {                    
                    $this->data['end_time'] = $this->session->userdata('end_time');

                } else {
                    //if not set, it means it's start of a new quiz

                    $start_t = new DateTime(date('Y-m-d').' '.$this->data['quiz']->start_time);
                    $end_t = new DateTime(date('Y-m-d').' '.$this->data['quiz']->end_time);
                    $diff_t = $start_t->diff($end_t);

                    $h = $diff_t->format('%h');
                    $m = $diff_t->format('%i');
                    $s = $diff_t->format('%s');

                    $now = $end_time = new DateTime(date('Y-m-d H:i:s'));
                    $end_time->modify('+'.$h.'hours +'.$m.'minutes +'.$s.'seconds');

                    $this->data['end_time'] = $end_time->format('Y-m-d H:i:s');

                    $this->session->set_userdata(array('start_time' => $now->format('Y-m-d H:i:s'), 'end_time' => $end_time->format('Y-m-d H:i:s')));

                }
                
                $this->data['id_enc'] = $id_enc;

                //question are converted into array format
                $this->load->model('ques_m');
                $ques_n_optn = $this->ques_m->ques_to_array($this->data['quiz']->id);
                $this->data['questions'] = $ques_n_optn['questions'];
                $this->data['options'] = $ques_n_optn['options'];
                $this->data['selected'] = array_fill(0, count($this->data['questions']), '-1');
                $this->data['selected']['quiz_id'] = $id_enc;
                $this->data['checksum'] = encrypt_id($this->session->userdata('user_id'));
                $this->data['title'] = $this->data['quiz']->title.' | Quiz Bucket';

                $this->load->view('quiz_run', $this->data);

            } else {
                //quiz start page

                $this->data['title'] = $this->data['quiz']->title.' | Quiz Bucket';
                $this->data['id_enc'] = encrypt_id($this->data['quiz']->id);
                $this->load->view('quiz_single', $this->data);
            }

        } else {
            //display free quiz

            $this->data['quiz'] = $this->quiz_m->get_by(array('prize_money' => 0, 'cost' => 0, 'active' => 1));
            $this->data['title'] = 'Free Quiz | Quiz Bucket';

            $this->load->view('quiz_free', $this->data);
        }
    }

    public function result($slug = NULL, $id_enc = NULL) {

        if($slug == NULL && $id_enc == NULL) {
            
            //show all results
            print_r('all results');

        } elseif($slug && $id_enc == NULL) {

            $this->data['quiz'] = $this->quiz_m->get_by(array('slug' => $slug));
            count($this->data['quiz']) || show_404();

            //show single result
            print_r('single results');
            //$this->load->view('result_single', $this->data);

        } elseif($slug && $id_enc) {

            $this->ion_auth->logged_in() || show_404();

            $id = decrypt_id($id_enc);
            $user_id = $this->session->userdata('user_id');

            $post['time_stamp'] = date('Y-m-d H:i:s');

            $this->data['quiz'] = $this->quiz_m->get_by(array('id' => $id, 'slug' => $slug), TRUE);
            count($this->data['quiz']) || show_404();

            $this->load->model('ques_m');
            $this->data['question'] = $this->ques_m->get_by(array('quiz_id' => $this->data['quiz']->id));

            $post['total_questions'] = $this->ques_m->total_questions($this->data['quiz']->id);

            $rules = $this->quiz_m->rules_result;
            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == TRUE) {

                if($this->data['quiz']->prize_money != 0) {
                    $end_time = new DateTime($this->data['quiz']->date.' '.$this->data['quiz']->end_time);

                    //if submission time is 36sec later than the end time of quiz, error is thrown
                    if((strtotime($post['time_stamp']) - strtotime($end_time->format('Y-m-d H:i:s'))) > 36) {
                        show_error('1.  Invalid submission!!!');
                    }
                } else {
                    $end_time = $this->session->userdata('end_time');
                    
                    //if submissiono time is 18sec later than end time of quiz, error is thrown
                    if((strtotime($post['time_stamp']) - strtotime($end_time)) > 18) {
                        show_error('7.  Invalid submission!!!');
                    }
                }

                //if checksum is not there of if cheksum is invalid show error
                if( $this->input->post('checksum') === FALSE || $user_id != decrypt_id($this->input->post('checksum')) ) {
                    show_error('2.  Invalid submission!!!');
                }

                //if answer is not set in session, error is thrown
                if($this->session->userdata('answers') === FALSE) {
                    show_error('3.  Invalid submission!!!');   
                } else {
                    $answers = $this->session->userdata('answers');
                    $this->session->unset_userdata('answers');
                    
                    if($answers['quiz_id'] != encrypt_id($this->data['quiz']->id)) {
                        show_error('4.  Invalid submission!!!');
                    }

                    unset($answers['quiz_id']);

                    foreach ($answers as $no => $ans) {
                        $n = $no + 1;
                        $form_data['q'.$n.'ans'] = $ans;
                    }
                }

                $post['score'] = 0;
                $post['attempted'] = 0;
                $post['total_correct'] = 0;
                $post['correct_starred'] = 0;

                for ($i = 1; $i <= $post['total_questions']; $i++) {
                    $question = $this->data['question'][$i-1];
                    
                    switch ($form_data['q'.$i.'ans']) {

                        case '1':
                        $post['attempted'] += 1;
                        if($this->ques_m->hash($question->option1) == $question->answer) {
                            $post['total_correct'] += 1;
                            $post['score'] += 1;

                            if($question->is_starred) {
                                $post['correct_starred'] += 1;
                            }
                        }
                        break;

                        case '2':
                        $post['attempted'] += 1;
                        if($this->ques_m->hash($question->option2) == $question->answer) {
                            $post['total_correct'] += 1;
                            $post['score'] += 1;
                            
                            if($question->is_starred) {
                                $post['correct_starred'] += 1;
                            }
                        }
                        break;
                        
                        case '3':
                        $post['attempted'] += 1;
                        if($this->ques_m->hash($question->option3) == $question->answer) {
                            $post['total_correct'] += 1;
                            $post['score'] += 1;
                            
                            if($question->is_starred) {
                                $post['correct_starred'] += 1;
                            }
                        }
                        break;
                        
                        case '4':
                        $post['attempted'] += 1;
                        if($this->ques_m->hash($question->option4) == $question->answer) {
                            $post['total_correct'] += 1;
                            $post['score'] += 1;
                            
                            if($question->is_starred) {
                                $post['correct_starred'] += 1;
                            }
                        }
                        break;

                    }

                }

                $post['user_id'] = $user_id;
                $post['quiz_id'] = $this->data['quiz']->id;

                $this->load->model('result_m');

                if($this->data['quiz']->prize_money == 0) {
                    $post['rank'] = (int) 0;
                    $this->session->unset_userdata('end_time');

                } else {
                    $post['rank'] = (int) 1;
                }

                $this->result_m->save($post);

                //load view showing result and rank
                $this->data['post'] = $post;
                $this->data['title'] = $this->data['quiz']->title.' Result | Quiz Bucket';
                $this->load->view('result_finish', $this->data);


            } else {
                //think about what to do here

                //can set some flash message like "there was some error during the result processing. resubmit or so"
                show_error('5.  Invalid submission!!!');
            }

        } else {
            show_404();
        }

    }

    public function result_save() {
        if($this->input->post('answers') === FALSE) {
            show_404();
        } else {
            $this->data['answers'] = json_decode(stripslashes($this->input->post('answers')));

            foreach ($this->data['answers'] as $no => $ans) {
                $a[$no] = $ans;
            }
            $answers = array('answers' => $a);

            $this->session->set_userdata($answers);
            echo json_encode(true);
        }
    }

}
?>