<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * @property Isdn_test_model $Isdn_test_model
 * @property Link_test_model $Link_test_model
 * @property Isdn_history_model $Isdn_history_model
 **/
class Isdn extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->exitRoleAdminMenu();
		$this->load->model('Isdn_test_model');
		$this->load->model('Link_test_model');
		$this->load->model('Isdn_history_model');
	}

	public function index()
	{
		$data['mem'] = $this->_mem;
		//load list Link test
		$data['list_link_test'] = $this->Link_test_model->getAll(null, null, ['name', 'id'])->result_array();
		$data['temp'] = 'page/utils/isdn-test';
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

			if ($this->_role != 1) {
				$filterMem = array(
					'field' => 'user',
					'operator' => 'eq',
					'value' => $this->session->userdata('User')
				);
				$tmp['filter']['filters'][] = $filterMem;
				if (!isset($tmp['filter']['logic'])) {
					$tmp['filter']['logic'] = 'and';
				}
			}
			#get all
			$tmpData = $this->Isdn_history_model->getAllPaging($tmp);

			//get all list link test
			$all_link_test = $this->Link_test_model->getAll(null, null, ['name', 'id'])->result_array();
			$map_link_test = array_column($all_link_test, 'name', 'id');

			#count total

			if ($tmpData['total'] > 0) {
				$count = isset($tmp['skip']) ? $tmp['skip'] + 1 : 1;
				for ($i = 0; $i < count($tmpData['data']); $i++) {
					$tmpData['data'][$i]['i'] = $count++;
					//map status
					$tmpData['data'][$i]['message'] = $this->mapErrorCode($tmpData['data'][$i]['status']);
					//map link test
					$tmpData['data'][$i]['name'] = $map_link_test[$tmpData['data'][$i]['id_link_test']];
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

	public function getRandIsdn()
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
				throw new Exception('Not found data');
			}
			//delete data isdn
			$isdn = $this->Isdn_test_model->getIsdnByRand(intval($tmp));
			if (empty($isdn)) {
				throw new Exception("Không tìm thấy số điện thoại trong nhóm");
			}


			//curl and return the data
			$url_test = trim($tmp_data->link) . trim($isdn);
			$tmp_test = $this->curl_isdn($url_test);
			if (empty($tmp_test)) {
				throw new Exception('Curl error');
			}
			$error_code = isset($tmp_test['Error_Code']) ? (int)$tmp_test['Error_Code'] : (int)$tmp_test['ErrorCode'];
			$rs = [
				'isdn' => $isdn,
				'name' => $tmp_data->name,
			];
			switch ($error_code) {
				case 0:
				case 1:
					$rs['message'] = $this->mapErrorCode($error_code);
					$rs['data'] = $tmp_test['data'] ?? [];
					$rs['status'] = true;
					break;
				case 6:
				default:
					$rs['message'] = $this->mapErrorCode($error_code);
					$rs['data'] = [];
					$rs['status'] = false;
					break;
			}
			$log_item = array(
				'user' => $this->session->userdata('User'),
				'id_link_test' => intval($tmp),
				'isdn' => $isdn,
				'status' => $rs['status'],
			);

			$this->Isdn_history_model->addNew($log_item);
			$dataResponse->data = $rs;
			$dataResponse->status = StatusResponse::_SUCCESS;

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	public function checkUpdate()
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
			$tmp_data = $this->Isdn_history_model->getOneByConditions($conditions);
			if (empty($tmp_data)) {
				throw new Exception('Not found data');
			}
			//get data link test
			$conditions_link = array(
				'id' => $tmp_data->id_link_test
			);
			$tmp_link_test = $this->Link_test_model->getOneByConditions($conditions_link);
			if (empty($tmp_link_test)) {
				throw new Exception('Not found data link test');
			}
			//curl and return the data
			$url_test = trim($tmp_link_test->link) . trim($tmp_data->isdn);
			$tmp_test = $this->curl_isdn($url_test);
			if (empty($tmp_test)) {
				throw new Exception('Curl error');
			}
			$error_code = isset($tmp_test['Error_Code']) ? (int)$tmp_test['Error_Code'] : (int)$tmp_test['ErrorCode'];
			$rs = [
				'isdn' => $tmp_data->isdn,
				'name' => $tmp_link_test->name,
			];
			switch ($error_code) {
				case 0:
				case 1:
					$rs['message'] = $this->mapErrorCode($error_code);
					$rs['data'] = $tmp_test['data'] ?? [];
					$rs['status'] = true;
					break;
				case 6:
				default:
					$rs['message'] = $this->mapErrorCode($error_code);
					$rs['data'] = [];
					$rs['status'] = false;
					break;
			}
			//check diff status
			if ($error_code != $tmp_data->status) {
				$this->Isdn_history_model->updateOne(['status' => $error_code], $conditions);
				$dataResponse->data = $rs;
				$dataResponse->is_update = true;
			} else {
				$dataResponse->data = $rs;
				$dataResponse->is_update = false;
			}

			$dataResponse->status = StatusResponse::_SUCCESS;
		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;
			$dataResponse->is_update = false;

		} finally {
			echo json_encode($dataResponse);
		}
	}

	private function mapErrorCode($code)
	{
		$code = intval($code);
		$error_desc = array(
			0 => 'Thành công',
			1 => 'Thành công, nhưng không có OTP',
			6 => 'Thất bại, số điện thoại không nằm trong danh sách',
			-1 => 'Lỗi không xác định',
		);
		return $error_desc[$code] ?? 'Lỗi không xác định';
	}

	/**
	 * @throws Exception
	 */
	private function curl_isdn($url)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 60,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HEADER => true,
		));

		$response = curl_exec($curl);

		if (curl_errno($curl)) {
			$error_msg = curl_error($curl);
			curl_close($curl);
			throw new Exception('cURL error: ' . $error_msg);
		}

		$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$body = substr($response, $header_size);

		if ($http_code !== 200) {
			curl_close($curl);
			throw new Exception("HTTP error: $http_code. Response: $body");
		}

		curl_close($curl);

		return json_decode($body, true);
	}

}
