<?php
class User_M extends MY_Model
{
    protected $_primary_key = 'user_id';
    protected $_table_name = 'users_profile';
    protected $_order_by = 'first_name asc, last_name asc';

    public $rules_login = array(
        'email' => array(
            'field' => 'email', 
            'label' => 'Email', 
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password', 
            'label' => 'Password', 
            'rules' => 'trim|required|xss_clean'
        ),
        'remember' => array(
        	'field' => 'remember',
        	'label' => 'Remember Me',
        	'rules' => 'trim'
        )
    );

    public $rules_signup = array(
        'first_name' => array(
            'field' => 'first_name', 
            'label' => 'First Name', 
            'rules' => 'trim|required|xss_clean'
        ),
        'last_name' => array(
            'field' => 'last_name', 
            'label' => 'Last Name', 
            'rules' => 'trim|required|xss_clean'
        ),
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|matches[confirm_password]'
        ),
        'confirm_password' => array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|xss_clean'
        ),
        'gender' => array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|required|xss_clean'
        ),
        'dob' => array(
            'field' => 'dob',
            'label' => 'Date of Birth',
            'rules' => 'trim|required|exact_length[10]|xss_clean'
        ),
        'edu_qual' => array(
            'field' => 'edu_qual',
            'label' => 'Educational Qualification',
            'rules' => 'trim|required|xss_clean'
        ),
        'address_1' => array(
            'field' => 'address_1',
            'label' => 'Address Line 1',
            'rules' => 'trim|required|xss_clean|max_length[100]'
        ),
        'address_2' => array(
            'field' => 'address_2',
            'label' => 'Address Line 2',
            'rules' => 'trim|required|xss_clean|max_length[100]'
        ),
        'city' => array(
            'field' => 'city',
            'label' => 'City',
            'rules' => 'trim|required|xss_clean'
        ),
        'state' => array(
            'field' => 'state',
            'label' => 'State',
            'rules' => 'trim|required|xss_clean'
        ),
        'pincode' => array(
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'trim|required|exact_length[6]|integer|xss_clean'
        ),
        'phone_no' => array(
            'field' => 'phone_no',
            'label' => 'Mobile No.',
            'rules' => 'trim|required|exact_length[10]|integer|xss_clean'
        )
    );

    public $rules_change_password = array(
        'old_password' => array(
            'field' => 'old_password',
            'label' => 'Old Password',
            'rules' => 'trim|required|xss_clean',
        ),
        'new_password' => array(
            'field' => 'new_password',
            'label' => 'New Password',
            'rules' => 'trim|required|xss_clean|matches[confirm_new_password]',
        ),
        'confirm_new_password' => array(
            'field' => 'confirm_new_password',
            'label' => 'Confirm New Password',
            'rules' => 'trim|required|xss_clean',
        ),
        'user_id' => array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'trim|required',
        )
    );

    public $rules_edit = array(
        'edu_qual' => array(
            'field' => 'edu_qual',
            'label' => 'Educational Qualification',
            'rules' => 'trim|required|xss_clean'
        ),
        'address' => array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|required|xss_clean|max_length[200]'
        ),
        'city' => array(
            'field' => 'city',
            'label' => 'City',
            'rules' => 'trim|required|xss_clean'
        ),
        'state' => array(
            'field' => 'state',
            'label' => 'State',
            'rules' => 'trim|required|xss_clean'
        ),
        'pincode' => array(
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'trim|required|exact_length[6]|integer|xss_clean'
        ),
        'phone_no' => array(
            'field' => 'phone_no',
            'label' => 'Mobile No.',
            'rules' => 'trim|required|exact_length[10]|integer|xss_clean'
        )
    );

    public $rules_forgot_password = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean',
        )
    );

    public $rules_reset_password = array(
        'password' => array(
            'field' => 'password',
            'label' => 'New Password',
            'rules' => 'trim|required|xss_clean|matches[confirm_password]',
        ),
        'confirm_password' => array(
            'field' => 'confirm_password',
            'label' => 'Confirm New Password',
            'rules' => 'trim|required|xss_clean',
        ),
        'user_id' => array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'trim|required',
        )
    );

    public $rules_deactivate = array(
        'user_id' => array(
            'field' => 'user_id',
            'label' => 'User ID',
            'rules' => 'trim|required',
        )
    );

}
?>