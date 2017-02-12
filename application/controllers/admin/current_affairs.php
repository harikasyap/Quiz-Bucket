<?php 
class Current_Affairs extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('currentaffairs_m');
    }

    function _remap($method) {
        $para = $this->uri->segment(3);
        $flag = FALSE;
        $functions = array('edit', 'delete', 'sort');
        
        foreach ($functions as $fnc) {
            if($para == $fnc) {
                $flag = TRUE;
                if($this->uri->segment(5)) {
                    $this->$fnc($this->uri->segment(4), $this->uri->segment(5));
                } else {
                    $this->$fnc($this->uri->segment(4));
                }
            }
        }

        if($flag == FALSE) {
            $this->index($para);
        }
    }

    public function index($id = NULL) {
        if ($id == NULL) {
            $this->load->view('admin/current_affairs/home', $this->data);          
        }
        else {
            $this->data['c_affair'] = $this->currentaffairs_m->get($id);
            count($this->data['c_affair']) || show_404();

            $this->load->view('admin/current_affairs/single', $this->data);
        }
    }

    public function edit ($id = NULL) {

        if ($id) {
            $this->data['c_affair'] = $this->currentaffairs_m->get($id);
            count($this->data['c_affair']) || show_404();
        }
        else {
            $this->data['c_affair'] = $this->currentaffairs_m->get_new();
        }

        $rules = $this->currentaffairs_m->rules;
        $this->form_validation->set_rules($rules);
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong>', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $post = $this->currentaffairs_m->array_from_post(array(
                'title',
                'description',
                'date'
            ));

            if($id) {
                $this->currentaffairs_m->save($post, $id);
                redirect('admin/current_affairs/'.$id);
            } else {
                $ca_id = $this->currentaffairs_m->save($post);
                redirect('admin/current_affairs/'.$ca_id);
            }            
        }
        
        $this->load->view('admin/current_affairs/edit', $this->data);

    }

    public function delete ($id) {
        $this->currentaffairs_m->delete($id);
        redirect('admin/current_affairs/sort', 'redirect');
    }

    public function sort ($y = NULL, $m = NULL) {

        $this->data['c_affairs_list'] = $this->currentaffairs_m->ym_list();

        if($y != NULL && $m == NULL) { //year based list
            $y = (string) $y;
            if(strlen($y) != 4) { show_404(); }

            $s_lmt = date($y.'-01-01');
            $e_lmt = date($y.'-12-31');
            $this->data['c_affairs_y'] = $this->currentaffairs_m->get_by(array('date >=' => $s_lmt, 'date <=' => $e_lmt));

            $this->data['year'] = $y;

            $this->load->view('admin/current_affairs/year', $this->data);

        } elseif($y != NULL && $m != NULL) { // month based list
            $y = (string) $y;
            $m = (string) $m;
            if((strlen($y) != 4) || (strlen($m) != 2)) { show_404(); }

            switch ($m) {
                case '01':
                case '03':
                case '05':
                case '07':
                case '08':
                case '10':
                case '12':
                    $d = '31';
                    break;
                case '04':
                case '06':
                case '09':
                case '11':
                    $d = '30';
                    break;
                case '02':
                    $y = (int) $y;
                    if((($y % 4) == 0) && ((($y % 100) != 0) || (($y % 400) == 0))) {
                        $d = '29';
                    } else {
                        $d = '28';
                    }
                    break;
                default:
                    show_404();
            }

            $s_lmt = date($y.'-'.$m.'-01');
            $e_lmt = date($y.'-'.$m.'-'.$d);
            $this->data['c_affairs_ym'] = $this->currentaffairs_m->get_by(array('date >=' => $s_lmt, 'date <=' => $e_lmt));

            $this->data['year'] = $y;
            $this->data['month'] = $m;

            $this->data['month_name'] = date("F", mktime(0, 0, 0, (int) $m, 1));

            $this->load->view('admin/current_affairs/month', $this->data);
        } else {
            $this->data['c_affairs'] = $this->currentaffairs_m->get();

            $this->load->view('admin/current_affairs/all', $this->data);
        }
    }

}
?>