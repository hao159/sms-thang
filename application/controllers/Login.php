<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends NH_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->input->post('user-name') && $this->input->post('password'))
        {
            $login = $this->aaa->authenticate($this->input->post('user-name'), $this->input->post('password'));
            if (!$login) {
				$this->session->set_flashdata('error-login', 'Tài khoản hoặc mật khẩu không khớp, vui lòng đăng nhập lại!');

            }
        }
	}

	public function index()
	{
		$data = array();
		$this->load->view('page/login', $data, FALSE);
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */