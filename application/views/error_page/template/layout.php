<?php
$data['template'] = $this->config->item('template');
$data['primary_nav'] = $this->config->item('primary_nav');
$data['template']['active_name'] = 'Không tìm thấy trang';
$this->load->view('error_page/template/inc/template_start', $data);

$this->load->view($temp);
?>

<?php
$this->load->view('template/inc/template_end', $data);
?>