<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * @property Aaa $aaa
 * @property Account_model $Account_model
 * @property Clone_model $Clone_model
 * @property Service_model $Service_model
 * @property Otp_service_v2_model $Otp_service_v2_model
 **/
class NH_Controller extends CI_Controller
{
	protected $_role;
	protected $_mem;
	protected $_server;
	protected $_admin_menu;
	protected $_clone_menu;

	public function __construct()
	{
		parent::__construct();
		$return_url = base_url(uri_string());

		$this->aaa->loginCheck(true, $return_url);
		# set config
		$router = (array)$this->router;

		if ($this->session->userdata("role") !== null && in_array($this->session->userdata("role"), [0, 1, 2])) {
			$this->_role = $this->session->userdata("role");
			$this->load->model('Account_model');
			if ($this->_role == 1) {
				//load distinct all mem
				$this->_mem = $this->Account_model->getDistinct(null, 'mem');
			} else {
				$this->_mem = $this->session->userdata("mem") !== null ? [$this->session->userdata("mem")] : [];
			}
		} else {
			$this->_role = 0;
			$this->_mem = $this->session->userdata("mem") !== null ? [$this->session->userdata("mem")] : [];
		}


		$this->config->set_item('active_page', empty(uri_string()) ? strtolower($router['default_controller']) : uri_string());
		$primary_nav = $this->config->item('primary_nav');


		//add the menu clone table
		$this->load->model('Service_model');
		$all_service = $this->Service_model->getAll()->result_array();
		if ($all_service) {
			foreach ($all_service as $service_clone) {
				$this->_clone_menu[] = array(
					'name' => $service_clone['name'],
					'description' => $service_clone['name'],
					'icon' => 'fad fa-clone',
					'type_user' => [1, 0, 2],
					'id' => 'clone_' . $service_clone['tbl_name'],
					'sub' => array(
						array(
							'name' => 'Statistics ' . $service_clone['name'],
							'description' => 'Statistics ' . $service_clone['name'],
							'type_user' => [1, 0, 2],
							'icon' => 'fad fa-clone',
							'url' => 'clone/' . $service_clone['tbl_name'] . '/report-statistic.html'
						),
						array(
							'name' => 'Detail ' . $service_clone['name'],
							'description' => 'Detail ' . $service_clone['name'],
							'type_user' => [1, 0, 2],
							'icon' => 'fad fa-clone',
							'url' => 'clone/' . $service_clone['tbl_name'] . '/report-detail.html'
						)
					)

				);
			}
			if ($this->_clone_menu) {
				$parent_clone_table[] = array(
					'name' => 'Clone table',
					'type_user' => [0, 1, 2],
					'icon' => 'fad fa-stream',
					'description' => 'Clone table',
					'sub' => $this->_clone_menu
				);
				$primary_nav = array_merge((array)$primary_nav, $parent_clone_table);
			}
		}

		if (in_array($this->_role, [1, 2])) {
			$this->_admin_menu = array(
				array(
					'name' => 'Admin menu',
					'opt' => '',
					'type_user' => [1, 2],
					'url' => 'header',
					'description' => 'Admin menu'
				),
				array(
					'name' => 'Clone table',
					'url' => 'create-clone-table.html',
					'type_user' => [1, 2],
					'icon' => 'far fa-layer-plus',
					'description' => 'Clone table'
				),
				array(
					'name' => 'Link test',
					'url' => 'management-link-test.html',
					'type_user' => [1, 2],
					'icon' => 'fas fa-link',
					'description' => 'Serial'
				),
				array(
					'name' => 'Serial',
					'url' => 'serial.html',
					'type_user' => [1, 2],
					'icon' => 'fas fa-barcode',
					'description' => 'Serial'
				),
			);
			$primary_nav = array_merge((array)$primary_nav, $this->_admin_menu);
		}
		$this->config->set_item('primary_nav', $primary_nav);
	}

	protected function exitRoleAdmin()
	{
		if (!in_array($this->_role, [1])) {
			http_response_code(404);
			if ($this->input->is_ajax_request) {
				echo json_encode(array(
					'error' => 'page or function not found',
					'status' => StatusResponse::_ERROR
				));
			} else {
				redirect(error_url(), 'refresh');
			}
		}
	}

	protected function exitRoleAdminMenu()
	{
		if (!in_array($this->_role, [1, 2])) {
			http_response_code(404);
			if ($this->input->is_ajax_request) {
				echo json_encode(array(
					'error' => 'page or function not found',
					'status' => StatusResponse::_ERROR
				));
			} else {
				redirect(error_url(), 'refresh');
			}
		}
	}

}

/* End of file ST_Controller.php */
/* Location: ./application/core/ST_Controller.php */
