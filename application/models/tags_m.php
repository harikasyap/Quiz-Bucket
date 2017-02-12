<?php
class Tags_M extends MY_Model
{
    protected $_table_name = 'tags';
    protected $_order_by = 'id asc';

    public $rules = array(
        'name' => array(
            'field' => 'name', 
            'label' => 'Tag name', 
            'rules' => 'trim|required|xss_clean|callback__unique_tag'
        )
    );

    public function get_recent($limit = 3) {
        $limit = (int) $limit;
        $this->db->limit($limit);
        return parent::get();
    }

    public function get_new ()
    {
        $tag = new stdClass();
        $tag->name = '';
        return $tag;
    }
}
?>