<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 * Account_model $Account_model
 **/

class Account extends NH_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Account_model");
	}

	public function index() {
		redirect(error_url(), 'refresh');

	}

	public function getDataDropdown()
	{
		$dataResponse = new stdClass();
		try {
			$tmp = $this->input->get();
			$select = ['User', 'mem'];
			$tmpData = $this->Account_model->getAllPaging($tmp, $select);

			$dataResponse = $tmpData;
		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally{
			echo json_encode($dataResponse);
		}
	}
	public function valueMapper()
	{
		return true;
	}

	public function changePass() {
		$dataResponse = new stdClass();
		try {
			if (empty($this->input->post('new')) AND empty($this->input->post('re_type'))) {
				throw new Exception("Invalid param input", 1);
			}
			if (strtoupper($this->input->post('new')) != strtoupper($this->input->post('re_type'))) {
				throw new Exception("Confirm password do not match!", 1);

			}

			$conditions = array(
				'user' => $this->session->userdata('user'),
			);
			$dataUpdate = array(
				'pass' => md5($this->input->post('new')),
			);

			$tmpUser = $this->Account_model->getOneByConditions($conditions);
			if ($tmpUser) {
				
				if ($this->Account_model->updateOne($dataUpdate, $conditions)) {
					$dataResponse->status = StatusResponse::_SUCCESS;
				}

			} else {
				throw new Exception("Error Processing Request", 1);

			}

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = StatusResponse::_ERROR;

		} finally {
			echo json_encode($dataResponse);
		}
	}
}
