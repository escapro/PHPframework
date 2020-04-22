<?php

use App\Core\Config;

if (!function_exists('config'))
{
	function config($name)
	{
		return Config::get($name);
	}
}