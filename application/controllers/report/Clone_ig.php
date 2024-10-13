<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Clone_ig_model $Clone_ig_model
 **/

class Clone_ig extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Clone_ig_model');
	}

	public function index()
	{
		#load ten tram can
		$data['mem'] = $this->_mem;

		$data['temp'] = 'page/report/clone_ig';
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
					'field' => 'mod',
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
			if (isset($tmp['filter']) AND isset($tmp['filter']['filters'])){
				for ($j = 0; $j < count($tmp['filter']['filters']); $j++) {
					if ($tmp['filter']['filters'][$j]['field'] == 'ig_uid'){
						$tmp['filter']['filters'][$j]['field'] = 'uid';
					}
				}
			}
			#get all
			$tmpData = $this->Clone_ig_model->getAllPaging($tmp);

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
}
