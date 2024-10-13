<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * @property Link_test_model $Link_test_model
 * @property Isdn_test_model $Isdn_test_model
 **/
class Management extends NH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->exitRoleAdminMenu();
		$this->load->model('Link_test_model');
	}

	public function index()
	{
		$data['mem'] = $this->_mem;

		$data['temp'] = 'page/link-test/management';
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
			$tmpData = $this->Link_test_model->getAllPaging($tmp);

			#count total

			if ($tmpData['total'] > 0) {
				$count = isset($tmp['skip']) ? $tmp['skip'] + 1 : 1;
				for ($i = 0; $i < count($tmpData['data']); $i++) {
					$tmpData['data'][$i]['i'] = $count++;
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
		try {
			if (empty($_POST['data'])) {
				throw new Exception('Empty payload');
			}
			$tmp = json_decode($this->input->post('data', true), true);
			if (empty($tmp)) {
				throw new Exception('Empty payload');
			}
			if (empty($tmp['name']) or empty($tmp['url'])) {
				throw new Exception('Invalid input');
			}
			if (!validate_url($tmp['url'])) {
				throw new Exception('Invalid url');
			}
			if (empty($tmp['file_name'])) {
				throw new Exception('Invalid file input');
			}
			if (empty($tmp['data_demo']) || !is_array($tmp['data_demo'])) {
				throw new Exception('Invalid data demo');
			}
			//check len name max 20
			if (strlen($tmp['name']) > 20) {
				throw new Exception('Name max length 20');
			}
			$item_add = array(
				'name' => $tmp['name'],
				'link' => $tmp['url'],
				'txt' => $tmp['file_name']
			);
			//check exist
			$conditions = array(
				'name' => $tmp['name']
			);
			$tmp_data = $this->Link_test_model->getOneByConditions($conditions);
			if (!empty($tmp_data)) {
				throw new Exception('Name already exist');
			}
			$id = $this->Link_test_model->addNew($item_add);
			if (empty($id)) {
				throw new Exception('Add new fail');
			}
			$insertData = array();
			foreach ($tmp['data_demo'] as $item) {
				$insertData[] = array(
					'id_link_test' => $id,
					'isdn' => $item['isdn'],
				);
			}
			$this->load->model('Isdn_test_model');
			$this->Isdn_test_model->addNewBatch($insertData);
			$dataResponse->insert = true;
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function delete()
	{
		$dataResponse = new stdClass();
		try {
			if (empty($_POST['id'])) {
				throw new Exception('Empty payload');
			}
			$tmp = $this->input->post('id', true);

			$conditions = array(
				'id' => intval($tmp)
			);
			$tmp_data = $this->Link_test_model->delete($conditions);
			//delete data isdn
			$this->load->model('Isdn_test_model');
			$this->Isdn_test_model->delete(array(
				'id_link_test' => intval($tmp)
			));

			$dataResponse->data = $tmp_data;
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function getone()
	{
		$dataResponse = new stdClass();
		try {
			if (empty($_POST['id'])) {
				throw new Exception('Empty payload');
			}
			$tmp = $this->input->post('id', true);

			$conditions = array(
				'id' => intval($tmp)
			);
			$tmp_data = $this->Link_test_model->getOneByConditions($conditions);
			if (empty($tmp_data)) {
				throw new Exception('Invalid data id, or empty data');
			}
			//get detail
			$this->load->model('Isdn_test_model');
			$tmp_data->detail = $this->Isdn_test_model->getAll(array(
				'id_link_test' => $tmp_data->id
			));
			$i = 1;
			foreach ($tmp_data->detail as $key => $item) {
				$tmp_data->detail[$key]['count'] = $i++;
			}
			$dataResponse->data = $tmp_data;
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function update()
	{
		$dataResponse = new stdClass();
		try {
			if (empty($_POST['data'])) {
				throw new Exception('Empty payload');
			}
			$tmp = json_decode($this->input->post('data', true), true);
			if (empty($tmp)) {
				throw new Exception('Empty payload');
			}
			if (empty($tmp['name']) or empty($tmp['url'])) {
				throw new Exception('Invalid input');
			}
			if (!validate_url($tmp['url'])) {
				throw new Exception('Invalid url');
			}
			if (strlen($tmp['name']) > 20) {
				throw new Exception('Name max length 20');
			}
			if (empty($tmp['data_demo']) || !is_array($tmp['data_demo'])) {
				throw new Exception('Invalid data Isdn');
			}

			$conditions = array(
				'id' => intval($tmp['id'])
			);
			//check exist
			$tmp_data = $this->Link_test_model->getOneByConditions($conditions);
			if (empty($tmp_data)) {
				throw new Exception('Invalid data id, or empty data');
			}

			$data_update = array(
				'name' => $tmp['name'],
				'link' => $tmp['url'],
			);
			$this->load->model('Isdn_test_model');
			if (!empty($tmp['file_name'])) {
				$data_update['txt'] = $tmp['file_name'];
				//delete all isdn and add new
				$this->Isdn_test_model->delete(array(
					'id_link_test' => $tmp_data->id));
				$insertData = array();
				foreach ($tmp['data_demo'] as $item) {
					$insertData[] = array(
						'id_link_test' => $tmp_data->id,
						'isdn' => $item['isdn'],
					);
				}
				$this->Isdn_test_model->addNewBatch($insertData);
			} else {
				// Edit some isdn
				$oldIsdn = $this->Isdn_test_model->getAll(array(
					'id_link_test' => $tmp_data->id));

				$newIsdn = array_column($tmp['data_demo'], 'isdn');

				// Find ISDNs to delete
				$oldIsdnList = array_column($oldIsdn, 'isdn');
				$isdnToDelete = array_diff($oldIsdnList, $newIsdn);

				if (!empty($isdnToDelete)) {
					$this->Isdn_test_model->deleteBatch($tmp_data->id, $isdnToDelete);
				}

				// Find ISDNs to add
				$isdnToAdd = array_diff($newIsdn, $oldIsdnList);
				$insertData = array();
				foreach ($isdnToAdd as $isdn) {
					$insertData[] = array(
						'id_link_test' => $tmp_data->id,
						'isdn' => $isdn
					);
				}

				if (!empty($insertData)) {
					$this->Isdn_test_model->addNewBatch($insertData);
				}
			}

			$tmp_data = $this->Link_test_model->updateOne($data_update, $conditions);
			if (empty($tmp_data)) {
				throw new Exception('Invalid data id, or empty data');
			}
			$dataResponse->data = $tmp_data;
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}
}
