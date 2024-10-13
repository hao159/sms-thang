<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Clone_model $Clone_model
 * @property Service_model $Service_model
 **/
class Clonetb extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Clone_model');
		$this->load->model('Service_model');
	}

	public function index()
	{
		http_response_code(404);
		if ($this->input->is_ajax_request) {
			echo json_encode(array(
				'error' => 'page not found',
				'status' => StatusResponse::_ERROR
			));
		} else {
			redirect(error_url(), 'refresh');
		}
	}

	public function detail()
	{
		#load ten tram can
		$tbl_name = $this->uri->segment(2);
		if (!$this->Service_model->checkExistsTbl($tbl_name)) {
			http_response_code(404);
			redirect(error_url(), 'refresh');
		}
		$data['mem'] = $this->_mem;
		$data['tbl_name'] = $tbl_name;

		$data['temp'] = 'page/report/clone_tbl/clone_detail';
		$this->load->view('template/layout', $data, FALSE);
	}

	public function statistic()
	{
		#load ten tram can
		$tbl_name = $this->uri->segment(2);
		if (!$this->Service_model->checkExistsTbl($tbl_name)) {
			http_response_code(404);
			redirect(error_url(), 'refresh');
		}
		$data['mem'] = $this->_mem;
		$data['tbl_name'] = $tbl_name;

		$data['temp'] = 'page/report/clone_tbl/clone_statistic';
		$this->load->view('template/layout', $data, FALSE);
	}

	public function getgrid_detail()
	{
		$dataResponse = new stdClass();
		$dataResponse->data = [];
		$dataResponse->total = 0;
		try {
			if (empty($_POST['filters'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = $this->uri->segment(2);
			if (!$this->Service_model->checkExistsTbl($tbl_name)) {
				http_response_code(404);
				throw new Exception('Invalid uri');
			}
			$tmp = json_decode($this->input->post('filters', true), true);
			if ($this->_role == 1) {
				if (isset($tmp['mem_filter'])) {
					$filterMem = array(
						'field' => 'mem',
						'operator' => 'eq',
						'value' => $tmp['mem_filter']
					);
					$tmp['filter']['filters'][] = $filterMem;
					if (!isset($tmp['filter']['logic'])) {
						$tmp['filter']['logic'] = 'and';
					}
				}
			} else {
				$filterMem = array(
					'field' => 'mod',
					'operator' => 'eq',
					'value' => $this->_mem[0] ?? ''
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])) {
					$tmp['filter']['logic'] = 'and';
				}
			}
			if (isset($tmp['start_date_filter'])) {
				$filterMem = array(
					'field' => 'created_time',
					'operator' => 'gte',
					'value' => strtotime($tmp['start_date_filter'] . ' 00:00:00')
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])) {
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
				if (!isset($tmp['filter']['logic'])) {
					$tmp['filter']['logic'] = 'and';
				}
			}
			if (isset($tmp['filter']) and isset($tmp['filter']['filters'])) {
				for ($j = 0; $j < count($tmp['filter']['filters']); $j++) {
					if ($tmp['filter']['filters'][$j]['field'] == 'ig_uid') {
						$tmp['filter']['filters'][$j]['field'] = 'uid';
					}
				}
			}
			#get all
			$tmpData = $this->Clone_model->getAllPaging2($tmp, $tbl_name);

			#count total

			if ($tmpData['total'] > 0) {
				$count = isset($tmp['skip']) ? $tmp['skip'] + 1 : 1;
				for ($i = 0; $i < count($tmpData['data']); $i++) {

					$tmpData['data'][$i]['ig_uid'] = $tmpData['data'][$i]['uid'];
					$tmpData['data'][$i]['created_time'] = date('d-m-Y H:i:s', $tmpData['data'][$i]['created_time']);
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

	public function getgrid_statistic()
	{
		$dataResponse = new stdClass();
		$dataResponse->data = [];
		$dataResponse->total = 0;
		try {
			if (empty($_POST['filters'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = $this->uri->segment(2);
			if (!$this->Service_model->checkExistsTbl($tbl_name)) {
				http_response_code(404);
				throw new Exception('Invalid uri');
			}
			$tmp = json_decode($this->input->post('filters', true), true);

			$where = array(
				'created_time >= ' => strtotime( date('d-m-Y 00:00:00') ),
				'created_time < ' => strtotime( date('d-m-Y 24:00:00') ),
			);
			if ($this->_role != 1) {
				$where['mod'] = $this->_mem[0] ?? '';
			}
			#get all
			$tmpData = $this->Clone_model->aggreate_statistic($where, $tbl_name);

			$dataResponse = $tmpData;
			$dataResponse['status'] = StatusResponse::_SUCCESS;

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
			if (empty($_POST['data'])) {
				throw new Exception('Empty payload');
			}
			$tbl_name = $this->uri->segment(2);
			if (!$this->Service_model->checkExistsTbl($tbl_name)) {
				http_response_code(404);
				throw new Exception('Invalid uri');
			}
			$tmp = json_decode($this->input->post('data', true), true);
			$count_result = array(
				'ok' => 0,
				'exists' => 0
			);
			$item_exists = [];
			for ($i=0;$i<count($tmp);$i++){
				$tmp[$i]['uid'] = $tmp[$i]['f_uid'];
				unset($tmp[$i]['f_uid']);
				unset($tmp[$i]['count']);
				$tmp[$i]['created_time'] = time();
				$conditions_check = array(
					'uid' => $tmp[$i]['uid'],
				);
				if ($this->Clone_model->countByConditions2($conditions_check, $tbl_name) > 0) {
					$count_result['exists']++;
					$tmp[$i]['f_uid'] = $tmp[$i]['uid'];
					$item_exists[] = $tmp[$i];
				} else {
					$tmpData = $this->Clone_model->addNew2($tmp[$i], $tbl_name);
					$count_result['ok']++;
				}

			}

			$dataResponse->insert = $count_result;
			$dataResponse->data = $item_exists;
			$dataResponse->total = count($item_exists);
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}
}
