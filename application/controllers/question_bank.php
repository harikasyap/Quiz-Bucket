<?php
class Question_Bank extends Frontend_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('questionbank_m');
    }

    function _remap($method, $args) {
        if(method_exists($this, $method)) {
            $this->$method($args);
        } else {
            if(isset($args[0])) {
                $this->index($method, $args[0]);
            } else {
                $this->index($method);
            }
        }
    }

    public function index($tag = NULL, $p = 1) {
        if($tag) {
            $this->load->model('tags_m');
            $this->data['tag'] = $this->tags_m->get_by(array('name' => $tag), TRUE);
            count($this->data['tag']) || show_404();
            
            $this->load->model('tags_questionbank_m');
            $this->data['ques'] = $this->tags_questionbank_m->get_by(array('tag_id' => $this->data['tag']->id));

            foreach ($this->data['ques'] as $q) {
                $this->data['questions'][] = $this->questionbank_m->get($q->question_id);
            }
            
            if(!empty($this->data['questions'])) {
    
                $total = count($this->data['questions']);
                $per_page = 10;

                $page_limit = $total/$per_page;
                $page_limit = (int) $page_limit;

                if($total % $per_page != 0) {
                  $page_limit += 1;
                }

                $p = (int) $p;

                if($p > $page_limit || $p < 1) {
                    show_404();
                }

                $this->data['pagination'] = ($total <= $per_page)? FALSE: TRUE;

                $skip = ($p-1)*$per_page;
                $limit = $per_page;

                foreach ($this->data['questions'] as $key => $val) {
                    if($skip > 0) {
                        $skip -= 1;
                        continue;
                    } else {
                        if($limit > 0) {
                            $this->data['t_questions'][] = $val;
                            $limit -= 1;
                        } else {
                            break;
                        }
                    }
                }

                if($this->data['pagination'] == TRUE) {
                    $this->load->library('pagination');

                    $config_pag['base_url'] = site_url('question_bank/'.$tag);
                    $config_pag['total_rows'] = $total;
                    $config_pag['per_page'] = $per_page;
                    $config_pag['uri_segment'] = 3;
                    $config_pag['num_links'] = 3;
                    $config_pag['full_tag_open'] = '<ul class="pagination">';
                    $config_pag['full_tag_close'] = '</ul>';
                    $config_pag['first_link'] = '«';
                    $config_pag['first_tag_open'] = '<li>';
                    $config_pag['first_tag_close'] = '</li>';
                    $config_pag['last_link'] = '»';
                    $config_pag['last_tag_open'] = '<li>';
                    $config_pag['last_tag_close'] = '</li>';
                    $config_pag['next_link'] = '&gt;';
                    $config_pag['next_tag_open'] = '<li>';
                    $config_pag['next_tag_close'] = '</li>';
                    $config_pag['prev_link'] = '&lt;';
                    $config_pag['prev_tag_open'] = '<li>';
                    $config_pag['prev_tag_close'] = '</li>';
                    $config_pag['cur_tag_open'] = '<li class="active"><a href="#">';
                    $config_pag['cur_tag_close'] = '</a></li>';
                    $config_pag['num_tag_open'] = '<li>';
                    $config_pag['num_tag_close'] = '</li>';
                    $config_pag['use_page_numbers'] = TRUE;

                    $this->pagination->initialize($config_pag);
                }

            }

            $this->data['title'] = 'Question Bank - '.ucwords(str_replace('-', ' ', $tag)).' | '.$this->data['site_title'];
            $this->load->view('question_bank_tag', $this->data);

        } else {
            $this->load->model('tags_m');
            $this->data['tags'] = $this->tags_m->get();

            $this->data['current_page'] = 'Question Bank';
            $this->data['title'] = 'Question Bank | '.$this->data['site_title'];
            
            $this->load->view('question_bank', $this->data);
        }
    }
}
?>