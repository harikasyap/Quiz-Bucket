<?php
class Tags_Questionbank_M extends MY_Model
{
    protected $_table_name = 'tags_questionbank';
    protected $_order_by = 'question_id desc';

    public function save($data) {
		$this->db->set($data);
		$this->db->insert($this->_table_name);
	}

	public function delete($q_id, $t_id) {
		$this->db->where(array('question_id' => $q_id, 'tag_id' => $t_id));
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
}
?>