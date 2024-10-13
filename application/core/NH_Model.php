<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
	code
*/
date_default_timezone_set('Asia/Ho_Chi_Minh');

class NH_Model extends CI_Model
{

	protected $_collection;
	protected $_now;
	protected $_current_user;

	public function __construct()
	{
		parent::__construct();
		$this->_now = date('Y-m-d H:i:s');
		$this->_cur_user = $this->session->userdata('User');
	}

	public function addNew($data)
	{
		// $data['createdBy'] = $this->_cur_user;
		//       $data['createdOn'] = $this->_now;
		//       $data['modifiedBy'] = $this->_cur_user;
		//       $data['modifiedOn'] = $this->_now;

		$this->db->insert($this->_collection, $data);
		return $this->db->insert_id();
	}

	public function getAll($wheres = null, $orderBy = null, $fieldSelect = null)
	{
		if (empty($wheres) && empty($orderBy) && empty($fieldSelect)) {
			return $this->db->get($this->_collection);

		} else if (!empty($wheres) && empty($orderBy) && empty($fieldSelect)) {
			$this->db->where($wheres);
			return $this->db->get($this->_collection);

		} else if (empty($wheres) && !empty($orderBy) && empty($fieldSelect)) {
			$this->db->order_by($orderBy);
			return $this->db->get($this->_collection);

		} else if (empty($wheres) && empty($orderBy) && !empty($fieldSelect)) {
			$this->db->select($fieldSelect);
			return $this->db->get($this->_collection);

		} else if (!empty($wheres) && !empty($orderBy) && empty($fieldSelect)) {
			$this->db->order_by($orderBy);
			$this->db->where($wheres);
			return $this->db->get($this->_collection);

		} else if (!empty($wheres) && empty($orderBy) && !empty($fieldSelect)) {
			$this->db->select($fieldSelect);
			$this->db->where($wheres);
			return $this->db->get($this->_collection);

		} else if (empty($wheres) && !empty($orderBy) && !empty($fieldSelect)) {
			$this->db->select($fieldSelect);
			$this->db->order_by($orderBy);
			return $this->db->get($this->_collection);

		} else {
			$this->db->select($fieldSelect);
			$this->db->order_by($orderBy);
			$this->db->where($wheres);
			return $this->db->get($this->_collection);
		}
	}


	public function getOneByConditions($wheres, $fieldSelect = null)
	{
		if ($fieldSelect) {
			$this->db->select($fieldSelect);
		}
		$this->db->where($wheres);
		$tmp = $this->db->get($this->_collection);
		if ($tmp->num_rows() > 0) {
			// code...
			return $tmp->result()[0];
		} else {
			return false;
		}
	}


	public function updateOne($data, $wheres)
	{
//		$data['modifiedBy'] = $this->_cur_user;
//		$data['modifiedAt'] = $this->_now;
		$this->db->where($wheres);
		return $this->db->update($this->_collection, $data);
	}


	public function countByConditions($wheres = null)
	{
		if ($wheres) {
			$this->db->where($wheres);

		}
		return $this->db->count_all_results($this->_collection);

	}

	public function delete($wheres)
	{
		if ($wheres and is_array($wheres)) {
			$this->db->where($wheres);
			$this->db->delete($this->_collection);
		} else {
			return FALSE;
		}
	}

	public function checkExists($wheres)
	{
		if ($this->countByConditions($wheres) > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getDistinct($wheres, $field)
	{
		$this->db->distinct();
		if ($wheres) {
			$this->db->where($wheres);
		}
		if (empty($field)) {
			return [];
		}
		$this->db->select($field);
		$this->db->from($this->_collection);
		$result = $this->db->get();
		if ($result->num_rows()) {
			return array_column($result->result_array(), $field);
		}
		return [];
	}

	public function getAllPaging($requests, $select = null)
	{
		$skip = $requests['skip'] ?? 0;
		$take = $requests['take'] ?? 1000;
		$sort = $requests['sort'] ?? null;
		$filter = $requests['filter'] ?? null;
		$aggregate = $requests['aggregate'] ?? null;

		if ($filter) {
			//count all data with conditions
			$this->add_filter_conditions($filter);
		}
		$total = $this->db->count_all_results($this->_collection, false);
		$this->db->select('*');
		if ($sort) {
			$this->add_sort_conditions($sort);
		}
		if ($select){
			$this->db->select($select);
		}
		$this->db->limit($take, $skip);
		$query = $this->db->get();

		$result = array(
			'total' => $total,
			'data' => $query->result_array()
		);

		if($aggregate){
			$result['aggregates'] = $this->aggregate_conditions($aggregate, $filter);

		}

		return $result;
	}

	private function add_sort_conditions($sort)
	{
		foreach ($sort as $s) {
			$field = $s['field'];
			$dir = $s['dir'];
			$this->db->order_by($field, $dir);
		}
	}

	private function add_filter_conditions($filter)
	{
		if (isset($filter['filters'])) {

			foreach ($filter['filters'] as $f) {

				if (isset($f['filters'])) {
					$this->db->group_start();
					$this->add_filter_conditions($f);
					$this->db->group_end();
				} else {
					if (isset($filter['logic'])) {
						if ($filter['logic'] == 'and') {
							$this->db->group_start();
						} elseif ($filter['logic'] == 'or') {
							$this->db->or_group_start();
						}
					}
					$operator = $f['operator'];
					$field = $f['field'];
					$value = $f['value'];

					switch ($operator) {
						case "eq":
							$this->db->where($field, $value);
							break;
						case "neq":
							$this->db->where("$field != ", $value);
							break;
						case "contains":
							$this->db->like($field, $value);
							break;
						case "doesnotcontain":
							$this->db->not_like($field, $value);
							break;
						case "startswith":
							$this->db->like($field, "$value%", 'after');
							break;
						case "endswith":
							$this->db->like($field, "%$value", 'before');
							break;
						case "gte":
							$this->db->where("$field >= ", $value);
							break;
						case "gt":
							$this->db->where("$field > ", $value);
							break;
						case "lte":
							$this->db->where("$field <= ", $value);
							break;
						case "lt":
							$this->db->where("$field < ", $value);
							break;
						default:
							break;
					}
					$this->db->group_end();
				}

			}

		}
	}
	private function aggregate_conditions($aggregate, $filter)
	{
		if ($filter){
			$this->add_filter_conditions($filter);
		}
		foreach ($aggregate as $agg) {
			$function = $agg['aggregate'];
			$field = $agg['field'];

			switch ($function) {
				case "count":
					$this->db->select("COUNT(`$field`) AS $field"."___"."$function");
					break;
				case "sum":
					$this->db->select("SUM(`$field`) AS $field"."___"."$function");
					break;
				case "average":
					$this->db->select("AVG(`$field`) AS $field"."___"."$function");
					break;
				case "min":
					$this->db->select("MIN(`$field`) AS $field"."___"."$function");
					break;
				case "max":
					$this->db->select("MAX(`$field`) AS $field"."___"."$function");
					break;
				default:
					break;
			}
		}
		$query = $this->db->get($this->_collection);
		return $this->render_aggregate($query->result_array());
//		return $query->result_array();
	}
	private function render_aggregate($data_aggregate)
	{
		$return = array();
		foreach ($data_aggregate[0] as $key => $value) {
			$split = explode('___', $key);
			$aggregate = $split[count($split) - 1];
			unset($split[count($split) - 1]);

			$fields = '';
			foreach ($split as $key => $sub_field) {
				$fields .= $sub_field.'.';
			}
			$fields = rtrim($fields, '.');

			if(isset($return[$fields])) {
				$return[$fields][$aggregate] = $value;
			} else{
				$return[$fields] = array(
					$aggregate => $value
				);
			}
		}
		return $return;
	}


	/**
	 * Lấy địa chỉ ip của client
	 */
	protected function get_client_ip()
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED']) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if (isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR']) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED']) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}
}

/* End of file ST_Model.php */
/* Location: ./application/core/ST_Model.php */
