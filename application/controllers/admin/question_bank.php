<?php 
class Question_Bank extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('questionbank_m');
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

    public function index($id = NULL) {
        if ($id == NULL) {
            $this->load->view('admin/question_bank/home', $this->data);
        }
        else {
            $this->data['question'] = $this->questionbank_m->get($id);
            count($this->data['question']) || show_404();

            $this->load->model('tags_questionbank_m');
            $this->data['tags'] = $this->tags_questionbank_m->get_by(array('question_id' => $id));

            $this->load->model('tags_m');

            foreach ($this->data['tags'] as $t) {
                $this->data['tags_list'][] = $this->tags_m->get($t->tag_id);
            }

            $this->load->view('admin/question_bank/single', $this->data);
        }
    }

    public function edit ($id = NULL) {

        if ($id) {
            $this->data['question'] = $this->questionbank_m->get($id);
            count($this->data['question']) || show_404();

            $this->load->model('tags_questionbank_m');
            $this->data['tags'] = $this->tags_questionbank_m->get_by(array('question_id' => $id));

            foreach ($this->data['tags'] as $t) {
                $this->data['tags_marked'][$t->tag_id] = $t->tag_id;
            }
        } else {
            $this->data['question'] = $this->questionbank_m->get_new();
        }

        $this->load->model('tags_m');
        $this->data['tag_list'] = $this->tags_m->get();

        $rules = $this->questionbank_m->rules(count($this->data['tag_list']));
        $this->form_validation->set_rules($rules);
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong>', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $post_question = $this->questionbank_m->array_from_post(array(
                'question',
                'answer'
            ));

            for ($i = 1; $i <= count($this->data['tag_list']) ; $i++) { 
                $tags_ar[] = 'tag'.$i;
            }
            $ip_tags = $this->questionbank_m->array_from_post($tags_ar);

            //if edit show the question single view
            //else redirect to add new question
            if($id) {
                $this->questionbank_m->save($post_question, $id);

                foreach ($ip_tags as $t_name => $t) {
                    if($t != FALSE) {
                        $tg = $this->tags_questionbank_m->get_by(array('question_id' => $id, 'tag_id' => $t));
                        if(count($tg) == 0) {
                            $post_tags['tag_id'] = $t;
                            $post_tags['question_id'] = $id;
                            $this->tags_questionbank_m->save($post_tags);
                        }
                    } else {
                        $t = substr($t_name, 3);
                        $tg = $this->tags_questionbank_m->get_by(array('question_id' => $id, 'tag_id' => $t));
                        if(count($tg)) {
                            $this->tags_questionbank_m->delete($id, $t);
                        }
                    }
                }

                redirect('admin/question_bank/'.$id);
            } else {
                $q_id = $this->questionbank_m->save($post_question);
                
                $this->load->model('tags_questionbank_m');
                foreach ($ip_tags as $t) {
                    if($t != FALSE) {
                        $post_tags['tag_id'] = $t;
                        $post_tags['question_id'] = $q_id;
                        $this->tags_questionbank_m->save($post_tags);
                    }
                }

                redirect('admin/question_bank/edit');
            }
        }
        
        $this->load->view('admin/question_bank/edit', $this->data);

    }

    public function add_multiple () {

        $this->load->model('tags_m');
        $this->data['tag_list'] = $this->tags_m->get();

        $rules = $this->questionbank_m->rules_multiple(count($this->data['tag_list']));
        $this->form_validation->set_rules($rules);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong>', '</div>');

        if ($this->form_validation->run() == TRUE) {
            for ($i = 1; $i <= 10; $i++) {
                $post['q'.$i] = $this->questionbank_m->array_from_post(array(
                    'question'.$i,
                    'answer'.$i
                ));
            }

            for ($i = 1; $i <= count($this->data['tag_list']) ; $i++) {
                $tags_ar[] = 'tag'.$i;
            }
            $ip_tags = $this->questionbank_m->array_from_post($tags_ar);

            $this->load->model('tags_questionbank_m');

            for ($i = 1; $i <= 10; $i++) {
                $post_q['question'] = $post['q'.$i]['question'.$i];
                $post_q['answer'] = $post['q'.$i]['answer'.$i];

                $q_id = $this->questionbank_m->save($post_q);

                foreach ($ip_tags as $t) {
                    if($t != FALSE) {
                        $post_tags['tag_id'] = $t;
                        $post_tags['question_id'] = $q_id;
                        $this->tags_questionbank_m->save($post_tags);
                    }
                }
            }

            redirect('admin/question_bank/add_multiple');
        }
        
        $this->load->view('admin/question_bank/add_multiple', $this->data);

    }

    public function questions() {
        $this->data['questions'] = $this->questionbank_m->get();

        if(count($this->data['questions'])) {

            $this->load->model('tags_m');            
            $tags = $this->tags_m->get();
            foreach ($tags as $t) {
                $this->data['tag_list'][$t->id] = $t->name;
            }

            $this->load->model('tags_questionbank_m');
            foreach ($this->data['questions'] as $q) {
                $this->data['questions_tags'][$q->id] =  $this->tags_questionbank_m->get_by(array('question_id' => $q->id));
            }
        }

        $this->load->view('admin/question_bank/questions', $this->data);
    }

    public function delete ($id) {
        $this->questionbank_m->delete($id);
        redirect('admin/question_bank', 'redirect');
    }

    public function tags ($id = NULL) {
        if($id) {
            $this->load->model('tags_m');
            $this->data['tag'] = $this->tags_m->get($id);
            count($this->data['tag']) || show_404();
            
            $this->load->model('tags_questionbank_m');
            $this->data['ques'] = $this->tags_questionbank_m->get_by(array('tag_id' => $this->data['tag']->id));

            if($this->data['ques']) {
                foreach ($this->data['ques'] as $q) {
                    $this->data['questions'][] = $this->questionbank_m->get($q->question_id);
                }

                foreach ($this->data['questions'] as $ques) {
                    $this->data['other_tags'][$ques->id] = $this->tags_questionbank_m->get_by(array('question_id' => $ques->id));
                }
            }

            $t = $this->tags_m->get();

            foreach ($t as $tgs) {
                $this->data['tags_list'][$tgs->id] = $tgs->name;
            }

            $this->load->view('admin/question_bank/tag_single', $this->data);

        } else {
            $this->load->model('tags_m');
            $this->data['tags'] = $this->tags_m->get();

            $this->load->view('admin/question_bank/tag_all', $this->data);
        }
    }

    public function tags_edit($id = NULL) {
        $this->load->model('tags_m');

        if ($id) {
            $this->data['tag'] = $this->tags_m->get($id);
            count($this->data['tag']) || show_404();
        } else {
            $this->data['tag'] = $this->tags_m->get_new();
        }

        $rules = $this->tags_m->rules;
        $this->form_validation->set_rules($rules);
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong>', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $post['name'] = url_title($this->input->post('name'), '-', TRUE);

            if($id) {
                $this->tags_m->save($post, $id);
                redirect('admin/question_bank/tags/'.$id);
            } else {
                $this->tags_m->save($post);
                redirect('admin/question_bank/tags/');
            }
        }
        
        $this->load->view('admin/question_bank/tag_edit', $this->data);
    }

    public function tags_delete($id) {
        $this->load->model('tags_m');
        $this->tags_m->delete($id);
        redirect('admin/question_bank/tags', 'redirect');
    }

    //check for any tag with same name
    public function _unique_tag ($str) {

        $id = $this->uri->segment(4);
        $this->db->where('name', strtolower($this->input->post('name')));
        ! $id || $this->db->where('id !=', $id);
        $this->load->model('tags_m');
        $tag = $this->tags_m->get();
        
        if (count($tag)) {
            $this->form_validation->set_message('_unique_tag', 'A Tag with the same name already exists.');
            return FALSE;
        }
        
        return TRUE;
    }

    //checks if atleast one tag is entered for the question
    public function _atleast_one_tag ($str) {
        $this->load->model('tags_m');
        $tags = $this->tags_m->get();
        $count = count($tags);

        $flag = FALSE;
        for ($i = 1; $i <= $count ; $i++) { 
            if($this->input->post('tag'.$i) !== FALSE) {
                $flag = TRUE;
                break;
            }
        }

        if($flag == FALSE) {
            $this->form_validation->set_message('_atleast_one_tag', 'Atleast one Tag is required.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>