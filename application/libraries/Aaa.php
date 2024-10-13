<?php 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * @property  MY_Controller $MY  Instance of super object Controller.
 */
class AAA
{

    // Private variables.  Do not change!
    private $_NH;

    public function __construct()
    {
        // Set the super object to a local variable for use later
        $this->_NH = &get_instance();
    }

    public function authenticate($username, $password)
    {
        $cd = array(
            "User" => $username,
            "Pass" => md5($password),
        );
        // Use mysql
        $query = $this->_NH->db->get_where('user', $cd);
        if (is_array($query->result()) && count($query->result()) > 0) {
            $rs = $query->result()[0];
  			$rs->isLogin = true;
            unset( $rs->Pass);
      
            $this->createLoginSession( (array) $rs);

            if ($this->_NH->input->get("return-url") && !empty($this->_NH->input->get("return-url"))) {
                redirect($this->_NH->input->get("return-url"), 'location');
            } else {
                redirect(base_url(), 'location');
            }
        } else {
            return false;

        }
    }

    public function loginCheck($redirect = false, $returnurl = "")
    {
        if ($this->_NH->router->class != 'login') {
            if ($this->_NH->session->userdata("isLogin")) {
                $this->logoutCheck();
            } else {

                /* User is not signed-in */
                if ($redirect === true) {
                    redirect(base_url('login') . '?return-url=' . urlencode($returnurl), 'location');
                } else {
                    return false;
                }
            }
        } else {
            if ($this->_NH->session->userdata("isLogin")) {
                redirect(base_url(), 'location');
            }
        }
    }

    public function logoutKey()
    {
        $sessionid = $this->_NH->session->userdata("id");
        //echo hash("md5", $sessionid . "I-WANT-TO-LOGOUT");

        return hash("md5", $sessionid . "I-WANT-TO-LOGOUT");
    }

    private function logoutCheck()
    {
        if ($this->_NH->input->get('signout') === $this->logoutKey()) {

            $this->_NH->session->sess_destroy();
            redirect(base_url(), 'location');
        }
    }

    private function createLoginSession($userdata)
    {
        $this->_NH->session->set_userdata($userdata);
    }

}
