<?php
class Currentaffairs_M extends MY_Model
{
    protected $_table_name = 'current_affairs';
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
            'rules' => 'trim|required|exact_length[10]|xss_clean'
        )
    );

    //This function serves in two ways:
    //1. When view is loaded, $ca properties used wont return any undefined variable error
    //2. We can set default values to the fields

    public function get_new ()
    {
        $ca = new stdClass();
        $ca->title = '';
        $ca->description = '';
        $ca->date = date('Y-m-d');
        return $ca;
    }

    public function get_recent($limit = 3) {
        $limit = (int) $limit;
        $this->db->where(array('date <=' => date('Y-m-d')));
        $this->db->limit($limit);
        return parent::get();
    }

    //year and month list
    public function ym_list() {
        $currentaffairs = $this->get();
        $list[0] = '';

        foreach ($currentaffairs as $ca) {
            $date = date('Y-F-d', strtotime($ca->date));
            $d_arr = explode('-', $date);

            $y = $d_arr[0];
            $m = $d_arr[1];
            $m_no = substr($ca->date, 5, 2);

            $list[$y][$m] = $m_no;
        }

        unset($list['0']);
        return $list;
    }

    //year and month based list
    public function sort($year, $month = NULL) {
        $this->db->where('YEAR(date)', $year);
        if($month != NULL) {
            $this->db->where('MONTH(date)', $month);
        }
    }
}
?>