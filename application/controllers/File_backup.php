<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class File_backup extends NH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->exitRoleAdmin();

		$this->load->model('Service_model');
	}

	public function index()
	{
		$data['temp'] = 'page/file-backup/index';
		$this->load->view('template/layout', $data, FALSE);
	}

	public function getgrid()
	{
		$dataResponse = new stdClass();
		$dataResponse->data = [];
		$dataResponse->total = 0;
		$dataResponse->status = 'error';

		try {
			// Nhận dữ liệu filter/paging từ request (POST hoặc GET)
			$filters = $this->input->post('filters', true);
			$skip = intval($this->input->post('skip', true));
			$take = intval($this->input->post('take', true));
			if (!$take) $take = 20; // Default page size

			$filterObj = [];
			if ($filters) {
				$filterObj = @json_decode($filters, true);
			}

			// Lấy list file từ thư mục
			$dir = __DIR__ . '/../../uploads/';
			$pattern = $dir . '*.{xls,xlsx,csv}';
			$files = [];
			$index = 0;
			foreach (glob($pattern, GLOB_BRACE) as $filePath) {
				$stat = stat($filePath);
				$files[] = [
					'filename' => basename($filePath),
					'created_at' => date('Y-m-d H:i:s', $stat['ctime']),
					'updated_at' => date('Y-m-d H:i:s', $stat['mtime']),
					'size' => filesize($filePath),
				];
			}

			// Filter theo tên file (giống Kendo: operator = 'contains')
			if (!empty($filterObj['filter']['filters'])) {
				foreach ($filterObj['filter']['filters'] as $filter) {
					if ($filter['field'] == 'filename' && $filter['operator'] == 'contains') {
						$keyword = mb_strtolower($filter['value']);
						$files = array_filter($files, function ($f) use ($keyword) {
							return strpos(mb_strtolower($f['filename']), $keyword) !== false;
						});
					}
					// Filter ngày tạo (Y-m-d)
					if ($filter['field'] == 'created_at') {
						if ($filter['operator'] == 'gte') {
							$ts = strtotime($filter['value'] . ' 00:00:00');
							$files = array_filter($files, function ($f) use ($ts) {
								return strtotime($f['created_at']) >= $ts;
							});
						}
						if ($filter['operator'] == 'lte') {
							$ts = strtotime($filter['value'] . ' 23:59:59');
							$files = array_filter($files, function ($f) use ($ts) {
								return strtotime($f['created_at']) <= $ts;
							});
						}
					}
				}
			}

			// Sắp xếp theo created_at giảm dần (tùy chọn)
			usort($files, function ($a, $b) {
				return strtotime($b['created_at']) - strtotime($a['created_at']);
			});
			//add index
			foreach ($files as $key => $file) {
				$files[$key]['id'] = $key + 1; // Thêm id cho mỗi file
			}

			// Total sau filter
			$dataResponse->total = count($files);

			// Paging: skip, take
			$dataResponse->data = array_slice(array_values($files), $skip, $take);

			$dataResponse->status = 'success';

		} catch (Exception $e) {
			$dataResponse->error = $e->getMessage();
			$dataResponse->status = 'error';
		} finally {
			header('Content-Type: application/json');
			echo json_encode($dataResponse);
		}
	}

	public function download($filename = '')
	{
		try {
			// Kiểm tra tên file hợp lệ: chỉ cho phép ký tự chữ, số, dấu gạch ngang, dấu gạch dưới và .xls, .xlsx, .csv
			if (empty($filename) || !preg_match('/^[a-zA-Z0-9_\-\.]+\.(xls|xlsx|csv)$/', $filename)) {
				show_404();
				return;
			}
			// Đường dẫn đến file
			$filePath = __DIR__ . '/../../uploads/' . $filename;
			if (!file_exists($filePath)) {
				show_404();
				return;
			}

			// Download file
			$this->load->helper('download');
			force_download($filePath, null); // Trả về file với đúng tên gốc
		} catch (Exception $e) {
			show_error('Không thể tải file: ' . $e->getMessage(), 500);
		}
	}

	public function view($filename = '')
	{
		// Kiểm tra tên file hợp lệ
		if (empty($filename) || !preg_match('/^[a-zA-Z0-9_\-\.]+\.(xls|xlsx|csv)$/', $filename)) {
			redirect(error_url(), 'refresh');
		}
		// Đường dẫn đến file
		$filePath = __DIR__ . '/../../uploads/' . $filename;
		if (!file_exists($filePath)) {
			redirect(error_url(), 'refresh');
		}
		$data['file_url'] = base_url('file-backup/download/' . $filename);
		$data['iframe_link'] = 'https://view.officeapps.live.com/op/view.aspx?src=' . rawurlencode($data['file_url']);;
		$data['filename'] = $filename;


		$data['temp'] = 'page/file-backup/view';
		$this->load->view('template/layout', $data, FALSE);
	}


}
