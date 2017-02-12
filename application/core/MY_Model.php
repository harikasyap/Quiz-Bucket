<?php
class MY_Model extends CI_Model
{
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = array();
	protected $_timestamps = FALSE;

	function __construct() {
		parent::__construct();
	}

	//When $id is not passed it gives the full result array
	//When $id is passed it returns a single matching row

	public function get($id = NULL, $single = FALSE) {
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif ($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();

	}
	
	//Returns result array based on the array $where containing the where statements
	//If a single result is needed, set $single to TRUE

	public function get_by($where, $single = FALSE) {

		$this->db->where($where);
		return $this->get(NULL, $single);

	}

	//If $id is not given, it is an insert. If $id is given it is an update
	//Array $data holds the data and function returns the $id of the insert/update

	public function save($data, $id = NULL) {
		
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		
		if ($id === NULL) {
			//!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		
		return $id;

	}

	//Single row with $id is dropped
	
	public function delete($id) {

		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);

	}

	//For all the fields given as an array $fields, it returns $post which is an array of POSTed values

	public function array_from_post($fields) {
		$post = array();
		foreach ($fields as $field) {
			$post[$field] = $this->input->post($field);
		}
		return $post;
	}
}
?>