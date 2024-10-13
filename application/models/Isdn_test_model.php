<?php

class Isdn_test_model extends NH_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_collection = 'isdn_test';
	}

	public function addNewBatch($data)
	{
		$this->create_table_if_not_exists();
		if (empty($data) or !is_array($data)) {
			return FALSE;
		}
		for ($i = 0; $i < count($data); $i++) {
			unset($data[$i]['count']);
		}
		return $this->db->insert_batch($this->_collection, $data);
	}

	public function getAll($wheres = null, $orderBy = null, $fieldSelect = null)
	{
		return parent::getAll($wheres, $orderBy, $fieldSelect)->result_array();
	}

	public function deleteBatch($id_link_test, $list_isdn)
	{
		$this->db->where('id_link_test', $id_link_test);
		$this->db->where_in('isdn', $list_isdn);
		return $this->db->delete($this->_collection);
	}

	public function getIsdnByRand($id_link_test)
	{
		$query = $this->db->select('id, isdn, used_times')
			->order_by('used_times', 'ASC') // Sắp xếp theo used_times tăng dần
			->limit(1)
			->get($this->_collection);
		if ($query->num_rows() > 0) {
			$phone = $query->row_array();

			// Tăng giá trị used_times cho số điện thoại này
			$this->db->set('used_times', '`used_times`+ 1', FALSE)
				->where('id', $phone['id'])
				->update($this->_collection);

			return $phone['isdn'];
		} else {
			return FALSE;
		}
	}

	public function create_table_if_not_exists()
	{
		// Check if the table exists
		if (!$this->db->table_exists($this->_collection)) {
			// Create the table
			$this->db->query("
                CREATE TABLE IF NOT EXISTS `{$this->_collection}` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `isdn` VARCHAR(20) NOT NULL,
                    `id_link_test` INT(11) NOT NULL,
                    `used_times` INT(11) DEFAULT 0,
                    `createOn` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    `modifyOn` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    INDEX `idx_isdn` (`isdn`),
                    INDEX `idx_id_link_test` (`id_link_test`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
		}
	}
}
