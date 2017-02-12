<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends Admin_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('ques_m');
        $this->load->model('quiz_m');
    }

    //If no ids are passed, it gets redirected to quiz create page

    public function index() {
        redirect('admin/quiz/edit');
    }

    public function edit ($p, $q = NULL) {

        //If $p only is set, then it means it is an add question option
        //If $p & $q both are set, it means it is an edit question

        if ($p && $q) {

            $this->data['question'] = $this->ques_m->get($q);
            count($this->data['question']) || show_404();

            $this->data['question']->quiz_id == $p || show_404();

            $this->data['quiz'] = $this->quiz_m->get($p);
            $this->data['total_questions'] = $this->ques_m->total_questions($p);


            //Options are hashed and passed to view for comparison
            $this->data['option1'] = $this->ques_m->hash($this->data['question']->option1);
            $this->data['option2'] = $this->ques_m->hash($this->data['question']->option2);
            $this->data['option3'] = $this->ques_m->hash($this->data['question']->option3);
            $this->data['option4'] = $this->ques_m->hash($this->data['question']->option4);

        }
        elseif ($p) {

            $this->data['quiz'] = $this->quiz_m->get($p);
            count($this->data['quiz']) || redirect('admin/quiz/edit');

            $this->data['total_questions'] = $this->ques_m->total_questions($p);
            $this->data['question'] = $this->ques_m->get_new();

        }
        else {
            redirect('admin/quiz/edit');   
        }

        $rules = $this->ques_m->rules;
        $this->form_validation->set_rules($rules);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong>', '</div>');

        //If form validation runs, page is redirected
        //If form validation fails,  it means values entered are not valid, so again the same view is loaded again

        if ($this->form_validation->run() == TRUE) {
            $post = $this->ques_m->array_from_post(array(
                'question', 
                'option1', 
                'option2', 
                'option3',
                'option4',
                'answer',
                'is_starred',
                'no'
            ));

            //Set the is_starred field

            $post['is_starred']=($post['is_starred'])? 1 : 0;

            //Set the answer field & hash it

            switch ($post['answer']) {
                case 1: $post['answer'] = $post['option1']; break;
                case 2: $post['answer'] = $post['option2']; break;
                case 3: $post['answer'] = $post['option3']; break;
                case 4: $post['answer'] = $post['option4']; break;
            }

            $post['answer'] = $this->ques_m->hash($post['answer']);

            //Set the quiz_id field

            $post['quiz_id'] = $p;

            //If edit, we check whether the no field entered is equal to its previous value. If yes we do nothing
            //If entered less than previous value, we select all questions between entered value and previous value, excluding previous value, and increment their no by one
            //If entered greater than previous value, we select all questions between entered value and previous value, excluding previous value, and decrement their no by one

            //If add question, we check whether the no field entered is eual to total questions + 1
            //If yes we do nothing, if no we increment all other questions whose no field is greater than or equal to entered value

            if ($p && $q) {
              
              $this->data['question'] = $this->ques_m->get($q);
              
              if($post['no'] != $this->data['question']->no) {

                if ($post['no'] < $this->data['question']->no) {
                    $this->data['others'] = $this->ques_m->get_by(array('quiz_id' => $p, 'no >=' => $post['no'], 'no <' => $this->data['question']->no));
                    
                    //no field of all such entries are increased by one and updated
                    foreach ($this->data['others'] as $others) {  
                        $ip['no'] = $others->no + 1;
                        $this->ques_m->save($ip, $others->id);
                    }

                } else {
                    $this->data['others'] = $this->ques_m->get_by(array('quiz_id' => $p, 'no >' => $this->data['question']->no, 'no <=' => $post['no']));
                    
                    //no field of all such entries are decreased by one and updated
                    foreach ($this->data['others'] as $others) {  
                        $ip['no'] = $others->no - 1;
                        $this->ques_m->save($ip, $others->id);
                    }

                }
              }
            } 
            elseif ($p) {

              if($post['no'] != $this->ques_m->total_questions($p)+1) {

                $this->data['others'] = $this->ques_m->get_by(array('quiz_id' => $p, 'no >=' => $post['no']));

                //no field of all such entries are increased by one and updated
                foreach ($this->data['others'] as $others) {
                    $ip['no'] = $others->no + 1;
                    $this->ques_m->save($ip, $others->id);
                }
              }
            }

            //If $p & $q both are set, it means it is an edit question. So we redirect back to the quiz view
            //If $p only is set, it means it is an add question. So we need to save the data and redirect back to the question view

            if($p && $q) {
                $this->ques_m->save($post, $q);
                redirect('admin/quiz/'.$p);
            } elseif($p) {
                $this->ques_m->save($post);
                $this->data['question'] = $this->ques_m->get_new();
                redirect('admin/question/edit/'.$p);
            }
            
        }

        $this->load->view('admin/quiz/question_edit', $this->data);

    }

    public function delete ($id) {

        $this->data['question'] = $this->ques_m->get($id);

        $this->ques_m->delete($id);

        //All questions no below this question, if any, are decreased by one
        $this->data['others'] = $this->ques_m->get_by(array('quiz_id' => $this->data['question']->quiz_id, 'no >' => $this->data['question']->no));
        if (count($this->data['others'])) {                     
            foreach ($this->data['others'] as $others) {
                $ip['no'] = $others->no - 1;
                $this->ques_m->save($ip, $others->id);
            }
        }

        redirect("admin/quiz/".$this->data['question']->quiz_id);

    }

    public function change_is_starred($id) {
        $this->data['question'] = $this->ques_m->get($id);

        $post['is_starred'] = ($this->data['question']->is_starred == 1)? 0: 1;
        $this->ques_m->save($post, $id);

        redirect('admin/quiz/'.$this->data['question']->quiz_id);
    }

    //Checks if any of the entered options are same

    public function _unique_options ($str) {

        $var1 = $this->input->post('option1');
        $var2 = $this->input->post('option2');
        $var3 = $this->input->post('option3');
        $var4 = $this->input->post('option4');

        if((($var1 == $var2) || ($var3 == $var4)) || (($var1 == $var3) || ($var2 == $var4)) || (($var1 == $var4) || ($var2 == $var3))) {
            $this->form_validation->set_message('_unique_options', 'All Options field should be unique.');
            return FALSE;
        }

        return TRUE;

    }

}

?>