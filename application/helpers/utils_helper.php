<?php

function get_client_ip()
{
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']) {
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else if (isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED']) {
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	} else if (isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR']) {
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	} else if (isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED']) {
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) {
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	} else {
		$ipaddress = 'UNKNOWN';
	}

	return $ipaddress;
}

function searchFromArray($key, $value, $array)
{
	$data = array();
	foreach ($array as $k => $val) {
		if (isset($val[$key]) and $val[$key] === $value) {
			$data[] = $val;
		}
	}
	return $data;
}

function multidimensional_search($parents, $searched)
{
	if (empty($searched) || empty($parents)) {
		return false;
	}

	foreach ($parents as $key => $value) {
		$exists = true;
		foreach ($searched as $skey => $svalue) {
			$exists = ($exists && isset($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
		}
		if ($exists) {
			return true;
		}
	}

	return false;
}

function validate_url($url)
{
	$pattern = '/\b(http|https)?:\/\/\S+/i';
	return preg_match($pattern, $url);
}
