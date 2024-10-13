<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Urls_model extends NH_Model {

	public function __construct() {
		parent::__construct();
		$this->_collection = 'url_download';

	}


}

/* End of file Urls_model.php */
/* Location: ./application/models/Urls_model.php */
