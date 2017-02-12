<?php
class Questionbank_M extends MY_Model
{
    protected $_table_name = 'question_bank';
    protected $_order_by = 'id desc';

    public function rules($count)
    {   
        $rule = array(
            'question' => array(
                'field' => 'question', 
                'label' => 'Question', 
                'rules' => 'trim|required|xss_clean'
            ),
            'answer' => array(
                'field' => 'answer', 
                'label' => 'Answer', 
                'rules' => 'trim|required|xss_clean'
            ),
            'tag1' => array(
                'field' => 'tag1',
                'label' => 'Tag1',
                'rules' => 'trim|callback__atleast_one_tag'
            )
        );

        for ($i = 2; $i <= $count ; $i++) {
            $rule['tag'.$i] = array(
                'field' => 'tag'.$i,
                'label' => 'Tag'.$i,
                'rules' => 'trim'
            );
        }
        return $rule;
    }

    public function rules_multiple($count)
    {   
        $rule = array(
            'question1' => array(
                'field' => 'question1', 
                'label' => 'Question 1', 
                'rules' => 'trim|required|xss_clean'
            ),
            'answer1' => array(
                'field' => 'answer1', 
                'label' => 'Answer 1', 
                'rules' => 'trim|required|xss_clean'
            ),
            'tag1' => array(
                'field' => 'tag1',
                'label' => 'Tag1',
                'rules' => 'trim|callback__atleast_one_tag'
            )
        );

        for ($i = 2; $i <= 10; $i++) { 
            $rule['question'.$i] = array(
                'field' => 'question'.$i,
                'label' => 'Question '.$i,
                'rules' => 'trim|required|xss_clean'
            );
            $rule['answer'.$i] = array(
                'field' => 'answer'.$i, 
                'label' => 'Answer '.$i, 
                'rules' => 'trim|required|xss_clean'
            );
        }

        $rule['tag1'] = array(
            'field' => 'tag1',
            'label' => 'Tag1',
            'rules' => 'trim|callback__atleast_one_tag'
        );

        for ($i = 2; $i <= $count; $i++) {
            $rule['tag'.$i] = array(
                'field' => 'tag'.$i,
                'label' => 'Tag'.$i,
                'rules' => 'trim'
            );
        }

        return $rule;
    }

    public function get_new ()
    {
        $qb = new stdClass();
        $qb->question = '';
        $qb->answer = '';
        return $qb;
    }
}
?>