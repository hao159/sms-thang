<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Account_model extends NH_Model {

	public function __construct() {
		parent::__construct();
		$this->_collection = 'user';

	}


}

/* End of file Account_model.php */
/* Location: ./application/models/Account_model.php */
