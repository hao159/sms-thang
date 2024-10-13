<?php
$data['template'] = $this->config->item('template');

#load functions

$data['primary_nav'] = $this->config->item('primary_nav');

function dequy($aaa, &$bbb, $ccc) {
	foreach ($aaa as $data) {
		if (isset($data['url'])) {
			if ($data['url'] == $ccc) {
				$bbb = [
					'name' => $data['name'],
					'icon' => $data['icon'] ?? '',
					'description' => $data['description'] ?? '',
				];
				break;
			}
		} else {
			dequy($data['sub'], $bbb, $ccc);
		}
	}
}
$active = ['name' => '', 'icon' => ''];
$data['template']['active_page'] = $this->config->item('active_page');
dequy($data['primary_nav'], $active, $data['template']['active_page']);
$data['template']['active_name'] = (isset($active['name']) AND $active['name'] != '') ? $active['name'] : 'World SMS - ADV';
$data['template']['active_icon'] = (isset($active['icon']) AND $active['icon'] != '') ? $active['icon'] : '';
$data['template']['active_description'] = (isset($active['description']) AND $active['description'] != '') ? $active['description'] : '';

$this->load->view('template/inc/template_start', $data);
$this->load->view('template/inc/template_scripts', $data);
$this->load->view('template/inc/page_head', $data);
$this->load->view($temp, $data);
$this->load->view('template/inc/page_footer', $data);
?>
<!-- END Page Content -->
<!-- Load and execute javascript code used only in this page -->

<!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps -->
<!-- <script src="//maps.google.com/maps/api/js?sensor=true"></script> -->
<!-- <script src="public/js/helpers/gmaps.min.js"></script> -->
<?php

$this->load->view('template/inc/template_end', $data);

?>

