<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * @property Urls_model $Urls_model
 **/
class Urls extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Urls_model');
	}

	public function index()
	{
		$data['mem'] = $this->_mem;

		$data['temp'] = 'page/utils/urls';
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

			if (isset($tmp['start_date_filter'])) {
				$filterMem = array(
					'field' => 'created_time',
					'operator' => 'gte',
					'value' => strtotime($tmp['start_date_filter'] . ' 00:00:00')
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])){
					$tmp['filter']['logic'] = 'and';
				}
			}
			if (isset($tmp['end_date_filter'])) {
				$filterMem = array(
					'field' => 'created_time',
					'operator' => 'lte',
					'value' => strtotime($tmp['end_date_filter'] . ' 23:59:59')
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])){
					$tmp['filter']['logic'] = 'and';
				}
			}
			#get all
			$tmpData = $this->Urls_model->getAllPaging($tmp);

			#count total

			if ($tmpData['total'] > 0) {
				$count = isset($tmp['skip']) ? $tmp['skip'] + 1 : 1;
				for ($i = 0; $i < count($tmpData['data']); $i++) {

					$tmpData['data'][$i]['created_time'] = date('d-m-Y', $tmpData['data'][$i]['created_time']);
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
			$this->exitRoleAdmin();
			if (empty($_POST['data'])) {
				throw new Exception('Empty payload');
			}
			$tmp = json_decode($this->input->post('data', true), true);
			if (empty($tmp)) {
				throw new Exception('Empty payload');
			}
			if (empty($tmp['name']) OR empty($tmp['url'])){
				throw new Exception('Invalid input');
			}
			if (!filter_var($tmp['url'], FILTER_VALIDATE_URL)) {
				throw new Exception('Invalid url');
			}
			$item_add = array(
				'name' => $tmp['name'],
				'url' => $tmp['url'],
			);
			$this->Urls_model->addNew($item_add);

			$dataResponse->insert = true;
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function delete(){
		$dataResponse = new stdClass();
		try {
			$this->exitRoleAdmin();
			if (empty($_POST['id'])) {
				throw new Exception('Empty payload');
			}
			$tmp = $this->input->post('id', true);

			$conditions = array(
				'id' => intval($tmp)
			);
			$tmp_data = $this->Urls_model->delete($conditions);

			$dataResponse->data = $tmp_data;
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function getone(){
		$dataResponse = new stdClass();
		try {
			$this->exitRoleAdmin();
			if (empty($_POST['id'])) {
				throw new Exception('Empty payload');
			}
			$tmp = $this->input->post('id', true);

			$conditions = array(
				'id' => intval($tmp)
			);
			$tmp_data = $this->Urls_model->getOneByConditions($conditions);
			if (empty($tmp_data)){
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

	public function update(){
		$dataResponse = new stdClass();
		try {
			$this->exitRoleAdmin();
			if (empty($_POST['data'])) {
				throw new Exception('Empty payload');
			}
			$tmp = json_decode($this->input->post('data', true), true);
			if (empty($tmp)) {
				throw new Exception('Empty payload');
			}
			if (empty($tmp['name']) OR empty($tmp['url'])){
				throw new Exception('Invalid input');
			}
			if (!filter_var($tmp['url'], FILTER_VALIDATE_URL)) {
				throw new Exception('Invalid url');
			}

			$conditions = array(
				'id' => intval($tmp['id'])
			);
			$data_update = array(
				'name' => $tmp['name'],
				'url' => $tmp['url'],
			);
			$tmp_data = $this->Urls_model->updateOne($data_update, $conditions);
			if (empty($tmp_data)){
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
