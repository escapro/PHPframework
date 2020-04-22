<?php

use App\Libs\Date;

if (!function_exists('to_seconds'))
{
	function to_seconds($string)
	{
		return Date::toSeconds($string);
	}
}

if (!function_exists('to_miliseconds'))
{
	function to_miliseconds($string)
	{
		return Date::toMiliseconds($string);
	}
}