<?php
class MY_Exceptions extends CI_Exceptions {
	public function show_404()
	{
		$CI =& get_instance();
		$this->data['current_page'] = '';
        $this->data['title'] = 'Oops! Page not found | Quiz Bucket';
        $CI->output->set_status_header('404');
		$CI->load->view('404_page', $this->data);
		echo $CI->output->get_output();
		exit;
	}
}