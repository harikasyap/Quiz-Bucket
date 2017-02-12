<?php
class Result_M extends MY_Model
{
	protected $_table_name = 'result';
	protected $_order_by = 'rank asc';
    protected $_primary_key = 'user_id';

    //ranking order: score -> correct_starred -> attempted -> date_time
    public function rank($q_id) {
        $mark_list = $this->get_by(array('quiz_id' => $q_id));

        $this->load->model('userquiz_m');
        
        $enroll_list[0] = 0;
        foreach ($mark_list as $user) {
            $enroll_list[$user->user_id] = $this->userquiz_m->get_by(array('user_id' => $user->user_id, 'quiz_id' => $quiz_id), TRUE);
        }
        unset($enroll_list[0]);

        $len = count($mark_list);

        for ($i = 0; $i < $len; $i++) {
            for ($j = 0; $j < $len; $j++) {
                if($i != $j) {

                    if($mark_list[$j]->score < $mark_list[$i]->score) {
                        $mark_list[$j]->rank += 1;
                    } elseif($mark_list[$j]->score == $mark_list[$i]->score) {
                        
                        if($mark_list[$j]->correct_starred < $mark_list[$i]->correct_starred) {
                            $mark_list[$j]->rank += 1;
                        } elseif($mark_list[$j]->correct_starred == $mark_list[$i]->correct_starred) {

                            if($mark_list[$j]->attempted < $mark_list[$i]->attempted) {
                                $mark_list[$j]->rank += 1;
                            } elseif($mark_list[$j]->attempted == $mark_list[$i]->attempted) {

                                if(strtotime($enroll_list[$mark_list[$j]->user_id]->date_time) >= strtotime($enroll_list[$mark_list[$i]->user_id]->date_time)) {
                                    $mark_list[$j]->rank += 1;
                                }
                            }
                        }
                    }

                }
            }
        }

        foreach ($mark_list as $user) {
            $post['rank'] = $user->rank;
            $this->save($post, $user->user_id, $q_id);
        }
    }

    public function save($data, $u_id = NULL, $q_id = NULL) {
        
        if ($u_id == NULL && $q_id == NULL) {
            $this->db->set($data);
            $this->db->insert($this->_table_name);
        }
        elseif($u_id != NULL && $q_id != NULL) {
            $this->db->set($data);
            $this->db->where(array('user_id' => $u_id, 'quiz_id' => $q_id));
            $this->db->update($this->_table_name);
        }

    }
}
?>