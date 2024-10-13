<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Errors extends NH_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function P_404()
    {
        $data['temp'] = 'error_page/p_404';
        $this->load->view('error_page/template/layout', $data, false);
    }

}

/* End of file Errors.php */
/* Location: ./application/controllers/Errors.php */
