<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Otp_apple_model extends NH_Model {

	public function __construct() {
		parent::__construct();
		$this->_collection = 'tbl_otp_apple';

	}

	public function delete_in($wheres, $where_in)
	{
		$this->db->where_in($where_in['field'], $where_in['values']);
		return parent::delete($wheres); // TODO: Change the autogenerated stub
	}
	public function max_of_time(){
		$this->db->select_max('time');
		$query = $this->db->get($this->_collection);
		$result = $query->row();
		return $result->time;
	}
}

/* End of file Otp_apple_model.php */
/* Location: ./application/models/Otp_apple_model.php */
