<?php

namespace App\Libs;

class Date {

	public static function toSeconds(String $string)
	{
		$result = 0;
		$period = 0;

		if (strpos($string, 'second') !== false) {
			$period = intval(trim($string,"second"));
			$result = $period;
		}
		else if (strpos($string, 'minute') !== false) {
			$period = intval(trim($string,"minute"));
			$result = 60*$period;
		}
		else if (strpos($string, 'hour') !== false) {
			$period = intval(trim($string,"hour"));
			$result = 3600*$period;
		}
		else if (strpos($string, 'day') !== false) {
			$period = intval(trim($string,"day"));
			$result = 3600*24*$period;
		}
		else if (strpos($string, 'week') !== false) {
			$period = intval(trim($string,"week"));
			$result = 3600*24*7*$period;
		}
		else if (strpos($string, 'month') !== false) {
			$period = intval(trim($string,"month"));
			$result = 3600*24*30*$period;
		}
		else if (strpos($string, 'year') !== false) {
			$period = intval(trim($string,"year"));
			$result = 3600*24*30*12*$period;
		}else {
			$result = 0;
		}
		
		return (int) $result;
	}

	public static function toMiliseconds(String $string)
	{
		return self::toSeconds($string) * 1000;
	}

	public static function toMinutes(String $string)
	{
		return self::toSeconds($string) / 60;
	}

	public static function toHours(String $string)
	{
		return self::toSeconds($string) / 60 / 60;
	}

	public static function toDays(String $string)
	{
		return self::toSeconds($string) / 60 / 60 / 24;
	}

	public static function toWeeks(String $string)
	{
		return self::toSeconds($string) / 60 / 60 / 24 / 7;
	}

	public static function toMonths(String $string)
	{
		return self::toSeconds($string) / 60 / 60 / 24 / 30;
	}

	public static function toYears(String $string)
	{
		return self::toSeconds($string) / 60 / 60 / 24 / 30 / 12;
	}
}