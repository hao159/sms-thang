<?php

class Isdn_history_model extends NH_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_collection = 'isdn_history';
	}

	public function addNew($data)
	{
		$this->create_table_if_not_exists();
		if (empty($data) or !is_array($data)) {
			return FALSE;
		}

		return $this->db->insert($this->_collection, $data);
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
                    `status` INT(11) NOT NULL,
                    `user` VARCHAR(20) NOT NULL,
                    `createOn` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    `modifyOn` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    INDEX `idx_isdn` (`isdn`),
                    INDEX `idx_id_link_test` (`id_link_test`),
                    INDEX `idx_user` (`user`),
                    INDEX `idx_status` (`status`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
		}
	}
}
