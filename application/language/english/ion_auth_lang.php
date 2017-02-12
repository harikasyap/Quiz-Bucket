<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'Account successfully created';
$lang['account_creation_unsuccessful'] 	 	 = 'Unable to create Account';
$lang['account_creation_duplicate_email'] 	 = 'Email already in use or Invalid';
$lang['account_creation_duplicate_username'] = 'Username already used or Invalid';
$lang['account_creation_missing_default_group'] = 'Default group is not set';
$lang['account_creation_invalid_default_group'] = 'Invalid default group name set';


// Password
$lang['password_change_successful'] 	 	 = 'Password successfully changed';
$lang['password_change_unsuccessful'] 	  	 = 'Unable to change Password';
$lang['forgot_password_successful'] 	 	 = 'Password reset email sent';
$lang['forgot_password_unsuccessful'] 	 	 = 'Unable to reset Password';

// Activation
$lang['activate_successful'] 		  	     = 'Account activated';
$lang['activate_unsuccessful'] 		 	     = 'Unable to activate Account';
$lang['deactivate_successful'] 		  	     = 'Account De-Activated';
$lang['deactivate_unsuccessful'] 	  	     = 'Unable to De-Activate Account';
$lang['activation_email_successful'] 	  	 = 'Activation email sent';
$lang['activation_email_unsuccessful']   	 = 'Unable to send Activation email';

// Login / Logout
$lang['login_successful'] 		  	         = 'Logged in successfully';
$lang['login_unsuccessful'] 		  	     = 'Incorrect Login';
$lang['login_unsuccessful_not_active'] 		 = 'Account is Inactive';
$lang['login_timeout']                       = 'Temporarily Locked Out.  Try again later.';
$lang['logout_successful'] 		 	         = 'Logged out successfully';

// Account Changes
$lang['update_successful'] 		 	         = 'Account Information successfully updated';
$lang['update_unsuccessful'] 		 	     = 'Unable to update Account Information';
$lang['delete_successful']               = 'User deleted';
$lang['delete_unsuccessful']           = 'Unable to delete User';

// Groups
$lang['group_creation_successful']  = 'Group created Successfully';
$lang['group_already_exists']       = 'Group name already taken';
$lang['group_update_successful']    = 'Group details updated';
$lang['group_delete_successful']    = 'Group deleted';
$lang['group_delete_unsuccessful'] 	= 'Unable to delete group';
$lang['group_delete_notallowed']    = 'Can\'t delete the administrators\' group';
$lang['group_name_required'] 		= 'Group name is a required field';

// Activation Email
$lang['email_activation_subject']            = 'Account Activation';
$lang['email_activate_heading']    = 'Activate account for %s';
$lang['email_activate_subheading'] = 'Please click this link to %s.';
$lang['email_activate_link']       = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Forgotten Password Verification';
$lang['email_forgot_password_heading']    = 'Reset Password for %s';
$lang['email_forgot_password_subheading'] = 'Please click this link to %s.';
$lang['email_forgot_password_link']       = 'Reset Your Password';

// New Password Email
$lang['email_new_password_subject']          = 'New Password';
$lang['email_new_password_heading']    = 'New Password for %s';
$lang['email_new_password_subheading'] = 'Your password has been reset to: %s';
