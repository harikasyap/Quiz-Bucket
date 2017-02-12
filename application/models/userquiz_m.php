<?php
class Userquiz_M extends MY_Model
{
    protected $_table_name = 'user_quiz';
    protected $_order_by = 'date_time desc';

    public function is_enrolled($where) {
		if(count($this->get_by($where, TRUE)) == 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function save($data, $u_id = NULL, $q_id = NULL) {
		
		if ($u_id === NULL && $q_id === NULL) {
			$this->db->set($data);
			$this->db->insert($this->_table_name);
		}
		elseif($u_id != NULL && $q_id != NULL) {
			$this->db->set($data);
			$this->db->where(array('user_id' => $u_id, 'quiz_id' => $q_id));
			$this->db->update($this->_table_name);
		}

	}

	public function enrolled_users ($q_id) {
        return count($this->get_by(array('quiz_id' => $q_id)));         
    }
}
?>