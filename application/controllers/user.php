<?php
class User extends Frontend_Controller
{    
    function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        
        $this->data['current_page'] = 'User';
    }

    /* in case of actions done on user acnt, if not logged in, we need to redirect to login page */

    public function index() {

        if (!$this->ion_auth->logged_in()) {
            redirect('user/login', 'refresh');
        } else {
            //if admin, show all users list
            //if user, show his/her profile
            if($this->ion_auth->is_admin()) {
                redirect('admin/users', 'refresh');
            } else {
                $this->data['user'] = $this->user_m->get($this->session->userdata('user_id'));

                $this->load->model('result_m');
                $this->data['results'] = $this->result_m->get_by(array('user_id' => $this->session->userdata('user_id')));
                $this->data['total_quiz'] = count($this->data['results']);

                $this->data['total_earnings'] = 0;
                $this->data['total_quizzes_brought'] = 0;
                $user = $this->ion_auth->where('id', $this->session->userdata('user_id'))->users()->row();
                $this->data['member_since'] = gmdate("d-m-Y", $user->created_on);

                if($this->data['total_quiz'] != 0) {
                    $this->load->model('quiz_m');

                    foreach ($this->data['results'] as $rslt) {
                        $quiz = $this->quiz_m->get($rslt->quiz_id);
                        $this->data['total_earnings'] += $quiz->prize_money;
                        $this->data['total_quizzes_brought'] += ($quiz->cost == 0)? 0 : 1;
                    }
                }

                $this->data['title'] = $this->data['user']->first_name.' '.$this->data['user']->last_name.' profile | Quiz Bucket';
                $this->load->view('user/profile', $this->data);
            }            
        }

    }

    public function login() {

        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
                redirect('admin/dashboard', 'refresh');
            } else {
                redirect('', 'refresh');                
            }
        }

        $rules = $this->user_m->rules_login;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $post = $this->user_m->array_from_post(array(
                'email', 
                'password', 
                'remember'
            ));

            $post['remember'] = ($post['remember'] == 1)? TRUE : FALSE;

            if($this->ion_auth->login($post['email'], $post['password'], $post['remember'])) {

                //set logged in success message
                $this->session->set_flashdata('notify', 'true');
                $this->session->set_flashdata('n_type', 'success');
                $this->session->set_flashdata('n_message', 'Logged in successfully');

                if ($this->ion_auth->is_admin()) {
                    redirect('admin/dashboard', 'refresh');
                } else {
                    redirect('', 'refresh');
                }
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('user/login', 'refresh');
            }
        }

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['title'] = 'Login | Quiz Bucket';

        $this->load->view('user/login', $this->data);

    }

    public function logout() {
        if (!$this->ion_auth->logged_in()) {
            redirect('user/login', 'refresh');
        } else {
            $this->ion_auth->logout();
           
            $this->session->set_flashdata('notify', 'true');
            $this->session->set_flashdata('n_type', 'success');
            $this->session->set_flashdata('n_message', 'Logged out successfully');

            redirect('', 'refresh');
        }
    }

    public function sign_up() {

        if ($this->ion_auth->logged_in()) {
            if($this->ion_auth->is_admin()) {
                redirect('admin/user','refresh');
            } else {
                redirect('', 'refresh');                
            }
        }

        $rules = $this->user_m->rules_signup;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $post = $this->user_m->array_from_post(array(
                'first_name',
                'last_name',
                'email',
                'password',
                'gender',
                'dob',
                'edu_qual',
                'address_1',
                'address_2',
                'city',
                'state',
                'pincode',
                'phone_no'
            ));

            $post['username'] = strtolower($post['first_name']).' '.strtolower($post['last_name']);
            $post['email'] = strtolower($post['email']);

            $post['user_id'] = $this->ion_auth->register($post['username'], $post['password'], $post['email']);

            if ($post['user_id']) {

                $post['address'] = $post['address_1'].', '.$post['address_2'];

                unset($post['username'], $post['address_1'], $post['address_2'], $post['email'], $post['password']);

                $this->user_m->save($post);

                //sign up succesfull message
                $this->session->set_flashdata('notify', 'true');
                $this->session->set_flashdata('n_type', 'success');
                $this->session->set_flashdata('n_message', 'Account successfully created. To complete the registration, click on the link send to your mail.');
                
                redirect('','refresh');
            }
        }

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['title'] = 'Sign Up | Quiz Bucket';

        $this->load->view('user/register', $this->data);

    }

    public function activate($id, $code = NULL) {
        if ($code) {
            $activation = $this->ion_auth->activate($id, $code);
        } elseif ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {

            $this->session->set_flashdata('notify', 'true');
            $this->session->set_flashdata('n_type', 'success');
            $this->session->set_flashdata('n_message', 'Account activated. Login and enjoy playing quizzes.');

            redirect('user/login', 'refresh');

        } else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());

            $this->session->set_flashdata('notify', 'true');
            $this->session->set_flashdata('n_type', 'error');
            $this->session->set_flashdata('n_message', 'Account activation unsuccessfull. Please contact admin at admin@quizbucket.com');

            redirect('','refresh');
        }
    }

    public function deactivate($id = NULL) {

        if (!$this->ion_auth->logged_in()) {
            redirect('user/login', 'refresh');
        }

        if($this->ion_auth->is_admin()) {
            if($id != NULL) {
                $this->ion_auth->deactivate($id);
                redirect('admin/users/'.$id,'refresh');
            } else {
                redirect('admin/users','refresh');
            }
        }

        $id = $this->session->userdata('user_id');
        $this->load->helper('obfuscate');

        $rules = $this->user_m->rules_deactivate;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {

            if($this->_valid_csrf_nonce() === FALSE || $id != decrypt_id($this->input->post('user_id'))) {
                show_error('This Account deactivation form did not pass our security checks');
            } else {
                $this->session->unset_userdata('csrfkey');
                $this->session->unset_userdata('csrfvalue');
            }

            $this->ion_auth->deactivate($id);

            $this->session->set_flashdata('notify', 'true');
            $this->session->set_flashdata('n_type', 'warning');
            $this->session->set_flashdata('n_message', 'Account De-Activated');

            redirect('', 'refresh');

        }

        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['user_id'] = encrypt_id($id);

        $this->data['message'] = (validation_errors()) ? validation_errors() : FALSE;
        $this->data['title'] = 'Deactivate account | Quiz Bucket';

        $this->load->view('user/deactivate', $this->data);

    }

    public function change_password() {

        if(!$this->ion_auth->logged_in()) {
            redirect('user/login', 'refresh');
        }

        $id = $this->session->userdata('user_id');
        $this->load->helper('obfuscate');

        $rules = $this->user_m->rules_change_password;
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() == TRUE) {
            $post = $this->user_m->array_from_post(array(
                'old_password', 
                'new_password',
                'user_id'
            ));

            if($this->_valid_csrf_nonce() === FALSE || $id != decrypt_id($post['user_id'])) {
                show_error('This Password Change form did not pass our security checks');
            } else {
                $this->session->unset_userdata('csrfkey');
                $this->session->unset_userdata('csrfvalue');
            }

            $email = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($email, $post['old_password'], $post['new_password']);

            if($change) {

                $this->ion_auth->logout();
                $this->ion_auth->login($email, $post['new_password']);  //login with the new password

                $this->session->set_flashdata('notify', 'true');
                $this->session->set_flashdata('n_type', 'success');
                $this->session->set_flashdata('n_message', 'Password successfully changed.');

                redirect('','refresh');

            } else {
                $this->session->set_flashdata('notify', 'true');
                $this->session->set_flashdata('n_type', 'error');
                $this->session->set_flashdata('n_message', 'Password change unsuccessfull. Please try again');

                redirect('user/change_password', 'refresh');
            }

        }

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['user_id'] = encrypt_id($id);

        $this->data['title'] = 'Change Password | Quiz Bucket';

        $this->load->view('user/change_password', $this->data);
        
    }

    public function edit() {

        if (!$this->ion_auth->logged_in()) {
            redirect('user/login', 'refresh');
        }

        $id = $this->session->userdata('user_id');
        $this->load->helper('obfuscate');

        $rules = $this->user_m->rules_edit;
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() == TRUE) {
            $post = $this->user_m->array_from_post(array(
                'edu_qual',
                'address',
                'city',
                'state',
                'pincode',
                'phone_no'
            ));

            if ($this->_valid_csrf_nonce() === FALSE || $id != decrypt_id($this->input->post('user_id'))) {
                show_error('This Edit Personal Information form did not pass our security checks');
            } else {
                $this->session->unset_userdata('csrfkey');
                $this->session->unset_userdata('csrfvalue');
            }

            $this->user_m->save($post, $id);

            $this->session->set_flashdata('notify', 'true');
            $this->session->set_flashdata('n_type', 'success');
            $this->session->set_flashdata('n_message', 'Account Information successfully updated.');

            redirect('user/edit', 'refresh');
        }

        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['user_id'] = encrypt_id($id);

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $this->data['u'] = $this->user_m->get($id);
        $this->data['title'] = 'Edit Information | Quiz Bucket';

        $this->load->view('user/edit', $this->data);

    }

    //step 1
    public function forgot_password() {

        if (!$this->ion_auth->logged_in()) {
            redirect('', 'refresh');
        }

        $rules = $this->user_m->rules_forgot_password;
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() == TRUE) {
            $user = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();

            if(empty($user)) {

                $this->session->set_flashdata('notify', 'true');
                $this->session->set_flashdata('n_type', 'error');
                $this->session->set_flashdata('n_message', 'Email not found. Please check and enter the correct email');

                redirect('user/forgot_password', 'refresh');
            }

            $forgotten = $this->ion_auth->forgotten_password($user->email);

            if($forgotten) {

                $this->session->set_flashdata('notify', 'true');
                $this->session->set_flashdata('n_type', 'success');
                $this->session->set_flashdata('n_message', 'Please check your email to reset your password.');

                redirect('','refresh');
            } else {
                $this->session->set_flashdata('notify', 'true');
                $this->session->set_flashdata('n_type', 'error');
                $this->session->set_flashdata('n_message', 'Password reset unsuccessfull. Please retry.');

                redirect('user/forgot_password', 'refresh');
            }
        }
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['title'] = 'Forgot Password | Quiz Bucket';

        $this->load->view('user/forgot_password', $this->data);
    }

    //step 2
    public function reset_password($code = NULL) {
        if($code == NULL) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        //if valid, display password reset form
        if($user) {

            $this->load->helper('obfuscate');

            $rules = $this->user_m->rules_reset_password;
            $this->form_validation->set_rules($rules);

            if($this->form_validation->run() == TRUE) {
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != decrypt_id($this->input->post('user_id'))) {
                    $this->ion_auth->clear_forgotten_password_code($code);
                    show_error('This Password Reset form did not pass our security checks');
                    //no need to redirect to forgot_password step as this is not a regular error
                } else {
                    $this->session->unset_userdata('csrfkey');
                    $this->session->unset_userdata('csrfvalue');
                }

                $email = $user->email;
                $change = $this->ion_auth->reset_password($email, $this->input->post('password'));

                if($change) {
                    $this->session->set_flashdata('notify', 'true');
                    $this->session->set_flashdata('n_type', 'success');
                    $this->session->set_flashdata('n_message', 'Password reset succesfull. Login and enjoy playing quizzes.');

                    redirect('user/login', 'redirect');
                } else {
                    $this->session->set_flashdata('notify', 'true');
                    $this->session->set_flashdata('n_type', 'error');
                    $this->session->set_flashdata('n_message', 'Password reset unsuccessfull.');
                    redirect('user/reset_password/'.$code, 'refresh');
                }
            }
    
            $this->data['user_id'] = encrypt_id($user->id);
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['csrf'] = $this->_get_csrf_nonce();

            $this->data['title'] = 'Reset Password | Quiz Bucket';            

            $this->load->view('user/reset_password', $this->data);

        } else { //else send them back to forgot password page
            $this->session->set_flashdata('notify', 'true');
            $this->session->set_flashdata('n_type', 'error');
            $this->session->set_flashdata('n_message', 'Password reset unsuccessfull. Please try again.');

            redirect('user/forgot_password', 'refresh');
        }
    }

    public function results() {
        $this->load->model('result_m');
        $this->data['results'] = $this->result_m->get_by(array('user_id' => $this->session->userdata('user_id')));
        
        if(!empty($this->data['results'])) {

            $this->load->model('quiz_m');

            foreach ($this->data['results'] as $rslt) {
                if($rslt->rank != 0) {
                    $this->data['quizzes_paid'][$rslt->quiz_id] = $this->quiz_m->get($rslt->quiz_id);                    
                } else {
                    $this->data['quizzes_free'][$rslt->quiz_id] = $this->quiz_m->get($rslt->quiz_id);
                }
            }
        }

        $this->data['title'] = 'Individual Results | Quiz Bucket';

        $this->load->view('user/results', $this->data);
    }

    function _get_csrf_nonce() {

        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_userdata(array('csrfkey' => $key, 'csrfvalue' => $value));

        return array($key => $value);
    
    }

    function _valid_csrf_nonce() {

        if ($this->input->post($this->session->userdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->userdata('csrfkey')) == $this->session->userdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

}
?>