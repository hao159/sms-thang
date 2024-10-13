<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Serial_model extends NH_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->_collection = 'serial';
	}

	public function addNewBatch($data)
	{
		if (empty($data) or !is_array($data)){
			return FALSE;
		}
		for ($i = 0; $i<count($data); $i++){
			unset($data[$i]['count']);
			$data[$i]['created_time'] = time();
		}
		return $this->db->insert_batch($this->_collection, $data);
	}
}
