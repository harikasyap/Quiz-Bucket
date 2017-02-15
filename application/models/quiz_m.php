<?php
class Quiz_M extends MY_Model
{
    protected $_table_name = 'quiz';
    protected $_order_by = 'date desc, id desc';

    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'description' => array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|required|xss_clean'
        ),
        'date' => array(
            'field' => 'date',
            'label' => 'Publish Date',
            'rules' => 'trim|required|exact_length[10]|callback__is_lt_today|xss_clean'
        ),
        'start_time' => array(
            'field' => 'start_time',
            'label' => 'From',
            'rules' => 'trim|required|exact_length[8]|callback__is_start_gt_end|xss_clean'
        ),
        'end_time' => array(
            'field' => 'end_time',
            'label' => 'To',
            'rules' => 'trim|required|exact_length[8]|xss_clean'
        ),
        'prize_money' => array(
            'field' => 'prize_money',
            'label' => 'Prize Money', 
            'rules' => 'trim|required|integer'
        ),
        'cost' => array(
            'field' => 'cost',
            'label' => 'Cost', 
            'rules' => 'trim|required|integer'
        ),
        'active' => array(
            'field' => 'active',
            'label' => 'Activate',
            'rules' => 'trim'
        )
    );
    
    public $rules_free = array(
        'checksum' => array(
            'field' => 'checksum',
            'label' => 'Checksum',
            'rules' => 'trim|required'
        )
    );

    public $rules_result = array(
        'checksum' => array(
            'field' => 'checksum',
            'label' => 'Checksum',
            'rules' => 'trim|required'
        )  
    );

    //This function serves in two ways:
    //1. When view is loaded, $quiz properties used wont return any undefined variable error
    //2. We can set default values to the fields

    public function get_new ()
    {
        $quiz = new stdClass();
        $quiz->title = '';
        $quiz->description = '';
        $quiz->date = date('Y-m-d');
        $quiz->start_time = '';
        $quiz->end_time = '';
        $quiz->prize_money = '';
        $quiz->cost = '';
        $quiz->active = 1;
        return $quiz;
    }

    public function get_recent($limit = 4) {
        $limit = (int) $limit;
        $this->db->where(array('date >=' => date('Y-m-d'), 'prize_money !=' => 0));
        $this->db->limit($limit);
        return parent::get();
    }

    //A recursive function for generating unique slug

    public function unique_slug($str, $i = 0) {
        if($i == 0) {
            $this->db->where('slug', $str);
        } else {
            $this->db->where('slug', $str.'_'.$i);
        }

        if(count($this->quiz_m->get())) {
            $this->unique_slug($str, $i+=1);            
        } else {
            $url = ($i == 0)? $str : $str.'_'.$i;
            return $url;
        }
    }

}
?>