<?php

use App\Core\Dev;

if (!function_exists('debugg'))
{
	function debugg($e)
	{
		return Dev::debugg($e);
	}
}