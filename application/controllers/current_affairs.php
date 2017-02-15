<?php
class Current_Affairs extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
        $this->load->model('currentaffairs_m');
    }

    function _remap($method, $args) {
        if(method_exists($this, $method)) {
            if(isset($args[0])) {
                if(isset($args[1])) {
                    $this->$method($args[0], $args[1]);
                } else {
                    $this->$method($args[0]);
                }
            } else {
                $this->$method();
            }
        } else {
            $this->index($method, $args);
        }
    }

    public function index($id = NULL) {
        if($id == NULL) {
            //show most recent 4
            $this->data['ca_recent'] = $this->currentaffairs_m->get_recent(4);
            $this->data['more'] = ($this->db->count_all('current_affairs') > 4)? TRUE: FALSE;        

            $this->data['sidebar'] = $this->currentaffairs_m->ym_list();

            $this->data['title'] = 'Current Affairs | '.$this->data['site_title'];
            $this->data['current_page'] = 'Current Affairs';
            
            $this->load->view('current_affairs', $this->data);

        } else {
            $this->data['c_affair'] = $this->currentaffairs_m->get($id);
            count($this->data['c_affair']) || show_404();

            //to avoid cases when id = 1, get(0) will be same as get()
            if($id-1 == 0) {
                $this->data['ca_previous'] = '';
            } else {
                $this->data['ca_previous'] = $this->currentaffairs_m->get($id-1);
            }
            $this->data['ca_next'] = $this->currentaffairs_m->get($id+1);

            $this->data['sidebar'] = $this->currentaffairs_m->ym_list();
            
            if(strlen($this->data['c_affair']->title) > 21) {
                $this->data['title'] = substr($this->data['c_affair']->title, 0, 30).'... | Current Affairs | '.$this->data['site_title'];
            } else {
                $this->data['title'] = $this->data['c_affair']->title.' | Current Affairs | '.$this->data['site_title'];
            }

            $this->load->view('current_affairs_single', $this->data);
        }
    }

    public function p($pno = NULL) {
        if($pno == NULL) {
            redirect('current_affairs/p/1','refresh');
        }

        $total = $this->db->count_all('current_affairs');
        $per_page = 4;

        $page_limit = $total/$per_page;
        $page_limit = (int) $page_limit;

        if($total % $per_page != 0) {
          $page_limit += 1;
        }

        $pno = (int) $pno;

        if($pno > $page_limit || $pno < 1) {
          show_404();
        }
        
        $this->data['sidebar'] = $this->currentaffairs_m->ym_list();
        $this->data['list'] = 'full';

        if($pno == 1) {
          $this->data['newer_link'] = '';
          $this->data['older_link'] = ($total > $per_page)? site_url('current_affairs/p/'.($pno+1)) : '';
        } elseif ($pno == $page_limit) {
          $this->data['newer_link'] = site_url('current_affairs/p/'.($pno-1));
          $this->data['older_link'] = '';
        } else {
          $this->data['newer_link'] = site_url('current_affairs/p/'.($pno-1));
          $this->data['older_link'] = site_url('current_affairs/p/'.($pno+1));
        }

        $this->db->limit($per_page, ($pno - 1)*$per_page);
        $this->data['current_affairs'] = $this->currentaffairs_m->get();

        $this->data['title'] = 'Current Affairs | '.$this->data['site_title'];
        $this->load->view('current_affairs_all', $this->data);
    }

    public function sort($period = NULL, $p = 1) {
        if($period) {
            $period = (string) $period;

            if(strlen($period) == 7) {

                $year = substr($period, 0, 4);
                $month = substr($period, 5, 2);
                $this->data['y'] = $year;
                $this->data['m'] = $month;
                if(substr($period, 4, 1) != '-') { show_404(); }

                $year = (int) $year;
                $month = (int) $month;

                $this->data['sidebar'] = $this->currentaffairs_m->ym_list();
                $this->data['list'] = 'month';
                
                $this->currentaffairs_m->sort($year, $month);
                $total = count($this->currentaffairs_m->get());
                
                $m =  date("F", mktime(0, 0, 0, $month, 1));

                $this->data['title'] = 'Current Affairs '.$year.' '.$m.' | '.$this->data['site_title'];

            } elseif(strlen($period) == 4) {

                $year = (int) $period;

                $this->data['y'] = $period;

                $this->data['sidebar'] = $this->currentaffairs_m->ym_list();
                $this->data['list'] = 'year';

                $this->currentaffairs_m->sort($year);
                $total = count($this->currentaffairs_m->get());

                $this->data['title'] = 'Current Affairs '.$year.' | '.$this->data['site_title'];

            } else {
                show_404();
            }

            if($total == 0 ) { show_404(); }
            
            $per_page = 4;
            $page_limit = $total/$per_page;
            $page_limit = (int) $page_limit;


            if($total % $per_page != 0) {
                $page_limit += 1;
            }

            $p = (int) $p;

            if($p > $page_limit || $p < 1) { show_404(); }

            if($p == 1) {
                $this->data['newer_link'] = '';
                $this->data['older_link'] = ($total > $per_page)? site_url('current_affairs/sort/'.$period.'/'.($p+1)) : '';
            } elseif ($p == $page_limit) {
                $this->data['newer_link'] = site_url('current_affairs/sort/'.$period.'/'.($p-1));
                $this->data['older_link'] = '';
            } else {
                $this->data['newer_link'] = site_url('current_affairs/sort/'.$period.'/'.($p-1));
                $this->data['older_link'] = site_url('current_affairs/sort/'.$period.'/'.($p+1));
            }

            $this->db->limit($per_page, ($p - 1)*$per_page);
            $this->data['current_affairs'] = $this->currentaffairs_m->get();

            $this->load->view('current_affairs_all', $this->data);

        } else {
            show_404();
        }
    }
}
?>