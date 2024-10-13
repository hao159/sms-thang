<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Otp_service_v2_model extends NH_Model {

	public function __construct() {
		parent::__construct();
		$this->_collection = 'tbl_otp_services_v2';

	}

	public function count_data_per_month($role, $mems)
	{
		$months = 12;
		$current_month = time(); // Get current timestamp
		$start_month = strtotime('-'.$months.' months', $current_month); // Get timestamp for 15 months ago
		$result = array();

		// Loop through each month
		while ($start_month <= $current_month) {
			$start_of_month = strtotime('first day of ' . date('F Y', $start_month)); // Get timestamp for first day of month
			$end_of_month = strtotime('last day of ' . date('F Y', $start_month)) + 86399; // Get timestamp for last day of month (add 86399 seconds for end of day)

			if ($role == 1){
				//admin
				$total_this_count = 0;
				foreach ($mems as $mem){
					$this->db->select_sum('count');
					$this->db->where('createtime >=', $start_of_month);
					$this->db->where('createtime <=', $end_of_month);
					$this->db->where('mem', $mem);
					$query = $this->db->get($this->_collection);

					$this_count = intval($query->row()->count);
					$total_this_count+=$this_count;
					$result['counts_'.$mem][] = $this_count;
				}
				$result['counts'][] = $total_this_count;
			}else{
				//mem
				$this->db->select_sum('count');
				$this->db->where('createtime >=', $start_of_month);
				$this->db->where('createtime <=', $end_of_month);
				$this->db->where('mem', $mems[0]);
				$query = $this->db->get($this->_collection);
				$this_count = intval($query->row()->count);
				$result['counts'][] = $this_count;
			}

			$result['labels'][] = date('F Y', $start_month);
			$start_month = strtotime('+1 month', $start_month); // Move to next month
		}
		$result['months'] = $months;
		return $result;
	}
}

/* End of file Otp_service_model.php */
/* Location: ./application/models/Otp_service_model.php */
