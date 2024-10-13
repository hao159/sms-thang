<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Otp_detail_v2_model $Otp_detail_v2_model
 **/

class Detail_v2 extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Otp_detail_v2_model');
	}

	public function index()
	{
		#load ten tram can
		$data['mem'] = $this->_mem;

		$data['temp'] = 'page/report/detail-v2';
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
					'field' => 'time',
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
					'field' => 'time',
					'operator' => 'lte',
					'value' => strtotime($tmp['end_date_filter'] . ' 23:59:59')
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])){
					$tmp['filter']['logic'] = 'and';
				}
			}
			#get all
			$tmpData = $this->Otp_detail_v2_model->getAllPaging($tmp);

			#count total

			if ($tmpData['total'] > 0) {
				$count = isset($tmp['skip']) ? $tmp['skip'] + 1 : 1;
				$pooling_timestamp = $this->Otp_detail_v2_model->max_of_time();
				for ($i = 0; $i < count($tmpData['data']); $i++) {

					$tmpData['data'][$i]['is_new'] = $tmpData['data'][$i]['time'] > intval($tmp['pooling_timestamp']);
					$tmpData['data'][$i]['time'] = date('d-m-Y H:i:s', $tmpData['data'][$i]['time']);
					$tmpData['data'][$i]['i'] = $count++;
				}
				$dataResponse = $tmpData;
				$dataResponse['pooling_timestamp'] = intval($pooling_timestamp);
				$dataResponse['status'] = StatusResponse::_SUCCESS;
			}

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
			if ($this->_role != 1){
				throw new Exception('Only admin can delete the data detail');
			}
			if (empty($_POST['filters'])) {
				throw new Exception('Empty payload');
			}
			$filters = json_decode($this->input->post('filters', true), true);


			if (date('d-m-Y', strtotime($filters['start_date_filter'])) != $filters['start_date_filter']){
				throw new Exception('Start date time is invalid');
			}
			if (date('d-m-Y', strtotime($filters['end_date_filter'])) != $filters['end_date_filter']){
				throw new Exception('End date time is invalid');
			}
			$start_date_filter = strtotime($filters['start_date_filter'] . ' 00:00:00');
			$end_date_filter = strtotime($filters['end_date_filter']. ' 24:00:00');
			if ($filters['mem_filter'] == 'all'){
				$mem_filter = $this->_mem;
			}else{
				$mem_filter = [$filters['mem_filter']];
			}
			$wheres =array(
				'time >=' => $start_date_filter,
				'time <' => $end_date_filter,
			);
			$tmpData = $this->Otp_detail_v2_model->delete_in($wheres, [
				'field' => 'mem',
				'values' => $mem_filter
			]);
			$dataResponse->status = StatusResponse::_SUCCESS;
			$dataResponse->data = $tmpData;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}
}
