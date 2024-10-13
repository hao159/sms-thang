<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Otp_service_model $Otp_service_model
 **/
class Statistic extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Otp_service_model');

	}

	public function index()
	{

		$data['mem'] = $this->_mem;

		$data['temp'] = 'page/report/statistic';
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
			if ($this->_role == 1){
				if (isset($tmp['mem_filter'])) {
					$filterMem = array(
						'field' => 'mem',
						'operator' => 'eq',
						'value' => $tmp['mem_filter']
					);
					$tmp['filter']['filters'][] = $filterMem;
					if (!isset($tmp['filter']['logic'])){
						$tmp['filter']['logic'] = 'and';
					}
				}
			}else{
				$filterMem = array(
					'field' => 'mem',
					'operator' => 'eq',
					'value' => $this->_mem[0] ?? ''
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])){
					$tmp['filter']['logic'] = 'and';
				}
			}
			if (isset($tmp['start_date_filter'])) {
				$filterMem = array(
					'field' => 'createtime',
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
					'field' => 'createtime',
					'operator' => 'lte',
					'value' => strtotime($tmp['end_date_filter'] . ' 23:59:59')
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])){
					$tmp['filter']['logic'] = 'and';
				}
			}
			#get all
			$tmpData = $this->Otp_service_model->getAllPaging($tmp);

			#count total

			if ($tmpData['total'] > 0) {
				$count = isset($tmp['skip']) ? $tmp['skip'] + 1 : 1;
				for ($i = 0; $i < count($tmpData['data']); $i++) {

					$tmpData['data'][$i]['createtime'] = date('d-m-Y', $tmpData['data'][$i]['createtime']);
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
			$tmp_data = $this->Otp_service_model->getOneByConditions($conditions);
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
			$tmp_data = $this->Otp_service_model->delete($conditions);

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
			if (empty($tmp['id']) OR empty($tmp['mem']) OR !isset($tmp['count'])){
				throw new Exception('Invalid payload');
			}

			$conditions = array(
				'id' => intval($tmp['id'])
			);
			$data_update = array(
				'mem' =>$tmp['mem'],
				'count' => intval($tmp['count'])
			);
			$tmp_data = $this->Otp_service_model->updateOne($data_update, $conditions);
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

	public function insert()
	{
		$dataResponse = new stdClass();
		try {
			$this->exitRoleAdmin();
			if (empty($_POST['data'])) {
				throw new Exception('Empty payload');
			}
			$tmp = json_decode($this->input->post('data', true), true);
			$count_result = array(
				'ok' => 0,
				'exists' => 0
			);
			foreach ($tmp as $item){
				unset($item['i']);
				$item['createtime'] = time();
				$tmpData = $this->Otp_service_model->addNew($item);
				$count_result['ok'] ++;

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


}

/* End of file Statistic.php */
/* Location: ./application/controllers/Statistic.php */
