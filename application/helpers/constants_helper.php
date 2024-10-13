<?php

function error_url()
{
	return base_url('404.html');
}


class StatusResponse
{
	const _SUCCESS = 'success';
	const _ERROR = 'error';
}