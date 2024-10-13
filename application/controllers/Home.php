<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Clone_ig_model $Clone_ig_model
 * @property Otp_service_model $Otp_service_model
 **/
class Home extends NH_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Clone_ig_model');
		$this->load->model('Otp_service_model');

	}

	public function index()
	{
		$data['data_chart'] = $this->Otp_service_model->count_data_per_month($this->_role, $this->_mem);
		$data['role'] = $this->_role;
		$data['mems'] = $this->_mem;
		$data['temp'] = 'page/home';
		$this->load->view('template/layout', $data, FALSE);
	}

	public function demo()
	{
		$queries = array();

		$serials = array('F73C2J5YHG6W', 'F4GTH01XHG6Y');
		$mamays = array('Mamay1', 'Mamay2');
		$mods = array('teamtitan', 'sala');

		for ($i = 0; $i < 5000; $i++) {
			$id = rand(1000000, 9999999);
			$uid = $this->generateRandomString(16);
			$pass = $this->generateRandomString(8);
			$cookie = 'datacookie';
			$twofa = '0';
			$createdTime = time();
			$mod = $mods[array_rand($mods)]; // Select a random mod value
			$novery = rand(0, 1);
			$geo = 'VN';
			$sell = rand(0, 1);
			$field282 = rand(0, 1);
			$live = rand(0, 1);
			$serial = $serials[array_rand($serials)]; // Select a random serial value
			$sent = '-';
			$phone = '-';
			$hotmail = '-';
			$passhotmail = '-';
			$mamay = $mamays[array_rand($mamays)]; // Select a random mamay value

			$query = "INSERT INTO `clone_ig` (`uid`, `pass`, `cookie`, `2fa`, `created_time`, `mod`, `novery`, `geo`, `sell`, `282`, `live`, `serial`, `sent`, `phone`, `hotmail`, `passhotmail`, `mamay`) VALUES
    ('$uid', '$pass', '$cookie', '$twofa', $createdTime, '$mod', b'$novery', '$geo', b'$sell', b'$field282', b'$live', '$serial', 1, '$phone', '$hotmail', '$passhotmail', '$mamay');";

			$queries[] = $query;
		}

// Output the queries
		foreach ($queries as $query) {
			echo $query . "<br>";
		}

// Function to generate a random string of specified length


	}

	private function generateRandomString($length)
	{
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
