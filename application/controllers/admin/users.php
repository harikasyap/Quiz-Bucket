<?php
class Users extends Admin_Controller
{    
    function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->library('ion_auth');
    }

    function _remap($method, $args) {
        if(method_exists($this, $method)) {
            if(isset($args[0])) {
                $this->$method($args[0]);
            } else {
                $this->$method();
            }
        } else {
            $this->index($method, $args);
        }
    }

    public function index($id = NULL) {
		
        if($id == NULL) {
            $this->data['users'] = $this->user_m->get();
            
            foreach ($this->data['users'] as $usrs) {
                $this->data['users_details'][$usrs->user_id] = $this->ion_auth->where('id', $usrs->user_id)->users()->row();
            }

            $this->load->view('admin/users/list', $this->data);
        } else {
            $this->data['user'] = $this->user_m->get($id);
            count($this->data['user']) || show_404();

            $this->data['user_details'] = $this->ion_auth->where('id', $this->data['user']->user_id)->users()->row();

            $this->load->view('admin/users/single', $this->data);

        }
		
    }

    //view and all to be set up
    public function admin_signup() {

        $rules = $this->user_m->rules_signup_admin;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $post = $this->user_m->array_from_post(array(
                'first_name',
                'last_name',
                'email',
                'password'
            ));

            $post['username'] = strtolower($post['first_name']).' '.strtolower($post['last_name']);
            $post['email'] = strtolower($post['email']);

            $user = $this->ion_auth->register($post['username'], $post['password'], $post['email']);

            if($user) {
                redirect('admin/users');
            }
        }

        $this->data['title'] = 'Sign Up | '.$this->data['site_title'];

        $this->load->view('admin/user/admin_register', $this->data);

    }
}
?>