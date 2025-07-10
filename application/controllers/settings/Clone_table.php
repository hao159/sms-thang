<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * @property Service_model $Service_model
 * @property Clone_model $Clone_model
 **/
class Clone_table extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->exitRoleAdmin();

		$this->load->model('Service_model');
	}

	public function index()
	{
		$data['mem'] = $this->_mem;

		$data['temp'] = 'page/settings/clone_table';
		$this->load->view('template/layout', $data, FALSE);
	}

	public function getgrid()
	{
		$dataResponse = new stdClass();
		$dataResponse->data = [];
		$dataResponse->total = 0;
		try {
			if (empty($_POST['filters'])) {
				throw new Exception('Empty payload');
			}
			$tmp = json_decode($this->input->post('filters', true), true);
			#get all
			$tmpData = $this->Service_model->getAllPaging($tmp);

			#count total
			$this->load->model('Clone_model');

			if ($tmpData['total'] > 0) {
				$count = isset($tmp['skip']) ? $tmp['skip'] + 1 : 1;
				for ($i = 0; $i < count($tmpData['data']); $i++) {

					$tmpData['data'][$i]['created_time'] = date('d-m-Y H:i:s', $tmpData['data'][$i]['created_time']);
					$tmpData['data'][$i]['i'] = $count++;
					$tmpData['data'][$i]['count'] = $this->Clone_model->countAllTable($tmpData['data'][$i]['tbl_name']);
				}
				$dataResponse = $tmpData;
				$dataResponse['status'] = StatusResponse::_SUCCESS;
			}

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function add()
	{
		$dataResponse = new stdClass();
		$dataResponse->status = StatusResponse::_ERROR;
		try {
			if (empty($_POST) or empty($_POST['tbl_name']) or empty($_POST['name_show'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = trim($this->input->post('tbl_name', true));
			$name_show = trim($this->input->post('name_show', true));
			if (strlen($tbl_name) > 30) {
				throw new Exception('Table name length can\'t over 30');
			}
			if (strlen($name_show) > 30) {
				throw new Exception('Name show length can\'t over 30');
			}
			if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $tbl_name)) {
				throw new Exception('Invalid table name format');
			}
			// check table
			if ($this->db->table_exists($tbl_name)) {
				throw new Exception('Table exists, pls chose another table name');
			}
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'unsigned' => TRUE,
					'auto_increment' => TRUE,
					'constraint' => '20'
				),
				'uid' => array(
					'type' => 'VARCHAR',
					'constraint' => '250',
					'unique' => TRUE,
					'default' => NULL
				),
				'pass' => array(
					'type' => 'VARCHAR',
					'constraint' => '250',
					'default' => NULL
				),
				'cookie' => array(
					'type' => 'TEXT',
					'constraint' => '200',
					'default' => NULL
				),
				'2fa' => array(
					'type' => 'VARCHAR',
					'constraint' => '250',
					'default' => NULL
				),
				'created_time' => array(
					'type' => 'INT',
					'constraint' => '250',
					'default' => NULL
				),
				'mod' => array(
					'type' => 'VARCHAR',
					'constraint' => '250',
					'default' => NULL
				),
				'novery' => array(
					'type' => 'BIT',
					'constraint' => '1'
				),
				'geo' => array(
					'type' => 'VARCHAR',
					'constraint' => '150'
				),
				'sell' => array(
					'type' => 'BIT',
					'constraint' => '1',
					'default' => NULL
				),
				'field_282' => array(
					'type' => 'BIT',
					'constraint' => '1',
					'default' => NULL
				),
				'live' => array(
					'type' => 'BIT',
					'constraint' => '1',
					'default' => NULL
				),
				'serial' => array(
					'type' => 'VARCHAR',
					'constraint' => '200',
					'default' => NULL
				),
				'sent' => array(
					'type' => 'INT',
					'constraint' => '11',
					'default' => NULL
				),
				'phone' => array(
					'type' => 'VARCHAR',
					'constraint' => '200',
					'default' => NULL
				),
				'hotmail' => array(
					'type' => 'VARCHAR',
					'constraint' => '200',
					'default' => NULL
				),
				'passhotmail' => array(
					'type' => 'VARCHAR',
					'constraint' => '200',
					'default' => NULL
				), 'meta' => array(
					'type' => 'VARCHAR',
					'constraint' => '200',
					'default' => NULL
				),
				'spam' => array(
					'type' => 'INT',
					'constraint' => '100',
					'default' => NULL
				),
			);
			$this->load->dbforge();
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table($tbl_name);
			$sql = "ALTER TABLE `{$tbl_name}` CHANGE `field_282` `282` BIT";
			$this->db->query($sql);
			// add to service tables
			$this->Service_model->addNew([
				'name' => $name_show,
				'tbl_name' => $tbl_name,
				'created_time' => time()
			]);
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function drop()
	{
		$dataResponse = new stdClass();
		$dataResponse->status = StatusResponse::_ERROR;
		try {
			if (empty($_POST) or empty($_POST['tbl_name'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = trim($this->input->post('tbl_name', true));
			if (strlen($tbl_name) > 30) {
				throw new Exception('Table name length can\'t over 30');
			}

			if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $tbl_name)) {
				throw new Exception('Invalid table name format');
			}
			// check table
			if ($this->db->table_exists($tbl_name)) {
				if ($this->Service_model->checkExistsTbl($tbl_name)) {
					$this->load->database();
					$this->db->truncate($tbl_name);

				} else {
					throw new Exception('Table don\'t exists, pls chose another table name');
				}
			} else {
				throw new Exception('Table don\'t exists, pls chose another table name');
			}

			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function download_all()
	{
		$dataResponse = new stdClass();
		$dataResponse->status = StatusResponse::_ERROR;
		try {
			if (empty($_POST) or empty($_POST['tbl_name'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = trim($this->input->post('tbl_name', true));
			if (strlen($tbl_name) > 30) {
				throw new Exception('Table name length can\'t over 30');
			}

			if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $tbl_name)) {
				throw new Exception('Invalid table name format');
			}
			// check table
			if ($this->db->table_exists($tbl_name)) {
				if ($this->Service_model->checkExistsTbl($tbl_name)) {
					$this->load->dbutil();
					$query = $this->db->query("SELECT * FROM $tbl_name");
					// Tạo dữ liệu CSV từ kết quả truy vấn
					$csv_data = $this->dbutil->csv_from_result($query);

					// Đặt tiêu đề cho phản hồi để tải xuống tệp CSV
					$this->load->helper('download');
					force_download("{$tbl_name}_data.csv", $csv_data);


				} else {
					throw new Exception('Table don\'t exists, pls chose another table name');
				}
			} else {
				throw new Exception('Table don\'t exists, pls chose another table name');
			}
		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function download_all_buffer()
	{
		$dataResponse = new stdClass();
		$dataResponse->status = StatusResponse::_ERROR;
		try {
			if (empty($_POST) or empty($_POST['tbl_name'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = trim($this->input->post('tbl_name', true));
			if (strlen($tbl_name) > 30) {
				throw new Exception('Table name length can\'t over 30');
			}

			if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $tbl_name)) {
				throw new Exception('Invalid table name format');
			}
			// check table
			if ($this->db->table_exists($tbl_name)) {
				if ($this->Service_model->checkExistsTbl($tbl_name)) {
					$this->load->database();
					$this->load->helper('download');

					// Thiết lập tiêu đề cho file CSV
					header('Content-Type: text/csv');
					header('Content-Disposition: attachment;filename=' . $tbl_name . 'data.csv');
					header('Cache-Control: max-age=0');

					// Mở output stream
					$output = fopen('php://output', 'w');

					$header = array('id', 'uid', 'pass', 'cookie', '2fa', 'created_time', 'mod', 'novery', 'geo', 'sell', '282', 'live', 'serial', 'sent', 'phone', 'hotmail', 'passhotmail', 'meta', 'spam');
					// Ghi tiêu đề vào file CSV
					fputcsv($output, $header);

					//limit offset
					$limit = 1000;
					$offset = 0;

					do {
						$query = $this->db->get($tbl_name, $limit, $offset);
						$rows = $query->result_array();
						foreach ($rows as $row) {
							//convert created_time
							$row['created_time'] = date('d-m-Y H:i:s', $row['created_time']);
							fputcsv($output, $row);
						}
						$offset += $limit;
					} while ($query->num_rows() == $limit);
					fclose($output);
					exit();

				} else {
					throw new Exception('Table don\'t exists, pls chose another table name');
				}
			} else {
				throw new Exception('Table don\'t exists, pls chose another table name');
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function delete_all()
	{
		$dataResponse = new stdClass();
		$dataResponse->status = StatusResponse::_ERROR;
		try {
			if (empty($_POST) or empty($_POST['tbl_name'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = trim($this->input->post('tbl_name', true));
			if (strlen($tbl_name) > 30) {
				throw new Exception('Table name length can\'t over 30');
			}

			if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $tbl_name)) {
				throw new Exception('Invalid table name format');
			}
			// check table
			$this->load->dbforge();
			if ($this->db->table_exists($tbl_name)) {
				if ($this->Service_model->checkExistsTbl($tbl_name)) {
					$this->dbforge->drop_table($tbl_name);
					$this->Service_model->delete(['tbl_name' => $tbl_name]);
				} else {
					throw new Exception('Table don\'t exists, pls chose another table name');
				}
			} else {
				throw new Exception('Table don\'t exists, pls chose another table name');
			}

			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();

		} finally {
			echo json_encode($dataResponse);
		}
	}
}
