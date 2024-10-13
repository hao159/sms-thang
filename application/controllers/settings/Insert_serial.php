<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * @property Serial_model $Serial_model
 **/
class Insert_serial extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->exitRoleAdminMenu();
		$this->load->model('Serial_model');
	}

	public function index()
	{
		$data['mem'] = $this->_mem;

		$data['temp'] = 'page/settings/serial';
		$this->load->view('template/layout', $data, FALSE);
	}

	public function insert()
	{
		$dataResponse = new stdClass();
		try {
			if (empty($_POST['data'])) {
				throw new Exception('Empty payload');
			}
			$tmp = json_decode($this->input->post('data', true), true);
			$count_result = array(
				'ok' => 0,
				'exists' => 0
			);
			foreach ($tmp as $item){
				$conditions_check = array(
					'serial' => $item['serial'],
					'mamay' => $item['mamay'],
				);
				if($this->Serial_model->countByConditions($conditions_check) > 0){
					$count_result['exists'] ++;
				}else{
					unset($item['count']);
					$item['created_time'] = time();
					$tmpData = $this->Serial_model->addNew($item);
					$count_result['ok'] ++;
				}

			}
			$dataResponse->insert = $count_result;
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
			if (empty($_POST['id']) or empty($_POST['serial'])) {
				throw new Exception('Empty payload');
			}
			$id = $this->input->post('id', true);
			$serial = $this->input->post('serial', true);
			$wheres = array(
				'id' => $id,
				'serial' => $serial
			);
			$tmpData = $this->Serial_model->delete($wheres);
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function delete_all()
	{
		$dataResponse = new stdClass();
		try {
			if (empty($_POST['user'])) {
				throw new Exception('Empty payload');
			}
			$user = $this->input->post('user', true);
			$wheres = array(
				'mem' => $user,
			);
			$tmpData = $this->Serial_model->delete($wheres);
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
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
			if (isset($tmp['user_filter'])) {
				$filterMem = array(
					'field' => 'mem',
					'operator' => 'eq',
					'value' => $tmp['user_filter']
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])) {
					$tmp['filter']['logic'] = 'and';
				}
			}
			#get all
			$tmpData = $this->Serial_model->getAllPaging($tmp);

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

}
