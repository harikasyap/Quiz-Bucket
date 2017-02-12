<?php
class Ques_M extends MY_Model
{
	protected $_table_name = 'question';
	protected $_order_by = 'no asc';

	public $rules = array(
        'question' => array(
            'field' => 'question', 
            'label' => 'Question', 
            'rules' => 'trim|required|xss_clean'
        ),
        'option1' => array(
            'field' => 'option1', 
            'label' => 'Option 1', 
            'rules' => 'trim|required|xss_clean|callback__unique_options'
        ),
        'option2' => array(
            'field' => 'option2', 
            'label' => 'Option 2', 
            'rules' => 'trim|required|xss_clean'
        ),
        'option3' => array(
            'field' => 'option3', 
            'label' => 'Option 3', 
            'rules' => 'trim|required|xss_clean'
        ),
        'option4' => array(
            'field' => 'option4', 
            'label' => 'Option 4', 
            'rules' => 'trim|required|xss_clean'
        ),
        'answer' => array(
            'field' => 'answer', 
            'label' => 'Answer', 
            'rules' => 'trim|required'
        ),
        'is_starred' => array(
            'field' => 'is_starred', 
            'label' => 'Starred', 
            'rules' => 'trim'
        ),
        'no' => array(
            'field' => 'no', 
            'label' => 'Question no.', 
            'rules' => 'trim|required|integer'
        )
    );

	//Delete all question of a parent id

	public function delete_quest ($p_id)
	{		
        $this->db->where(array('quiz_id'=>$p_id));
		$this->db->delete($this->_table_name);		
	}

    //Hashed version of the string is returned with the encryption key concatinated to it

    public function hash ($string)
    {
        return hash('sha512', $string.config_item('encryption_key'));
    }

    //Returns the total no of questions of a quiz

    public function total_questions ($id)
    {
        return count($this->get_by(array('quiz_id' => $id)));         
    }

    //Returns the total no of starred questions of a quiz

    public function total_starred ($id)
    {
        return count($this->get_by(array('quiz_id' => $id, 'is_starred' => 1)));
    }

	//This function serves in two ways:
    //1. When view is loaded, $question properties used wont return any undefined variable error
    //2. We can set default values to the fields

	public function get_new ()
    {
        $ques = new stdClass();
        $ques->quiz_id = '';
        $ques->question = '';
        $ques->option1 = '';
        $ques->option2 = '';
        $ques->option3 = '';
        $ques->option4 = '';
        $ques->answer = '';
        $ques->is_starred = 0;
        $ques->no = 0;
        return $ques;
    }

    //for converting questions & options into array format
    public function ques_to_array($q_id) {
        $questions = $this->get_by(array('quiz_id' => $q_id));
        if($questions) {
            foreach ($questions as $data) {
                $ques[] = $data->question;
                $opt[] = array($data->option1, $data->option2, $data->option3, $data->option4);
            }
            $quiz_data['questions'] = $ques;
            $quiz_data['options'] = $opt;
            
            return $quiz_data;
        } else {
            $quiz_data['questions'] = FALSE;
            $quiz_data['options'] = FALSE;

            return $quiz_data;
        }

    }

}
?>