<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Service_model extends NH_Model {

	public function __construct() {
		parent::__construct();
		$this->_collection = 'tbl_services';

	}
	public function checkExistsTbl($clt)
	{
		if (empty($clt) or !$this->db->table_exists($clt)) {
			return FALSE;
		}
		//check tiep co nam trong bang service ko
		return $this->checkExists(array(
			'tbl_name' => $clt
		));

	}
}

/* End of file Service_model.php */
/* Location: ./application/models/Service_model.php */
