<?php

use App\Core\Security;

if (!function_exists('csrf_field'))
{
	function csrf_field()
	{
		return Security::csrf_field();
	}
}