<?php 
namespace app\core;

use IntlDateFormatter;
use DateTimeZone;
use DateTime;

// use statement, does not care of place of file, just needs to find i 

class TimeHelper{
	public static function DTOutput($s_datetime){
		// create a datetime object in the timezon of reference fo DB data
		$datetime = new DateTime($s_datetime, new DateTimeZone('UTC'));
		// TODO: pick the timezone
		global $tz;
		// $timezone='UTC';
		global $lang;
		$fmt = new IntlDateFormatter(
			$lang,
			// IntlDateFormatter::LONG, // IntlDateFormatter::MEDIUM, // IntlDateFormatter::SHORT
			IntlDateFormatter::MEDIUM, // date format
			IntlDateFormatter::MEDIUM, // time format
			$tz
		);
		return $fmt->format($datetime);
	}

	public static function DTInput($s_datetime){
		// create a datetime objcet in the local timezone
		try {
			global $tz; // import tz from the global something space 
			$datetime = new DateTime($s_datetime, new DateTimeZone($tz));
			// change the timezone
			$datetime->setTimezone(new DateTimeZone('UTC'));
			// return output to a standard string format
			return $datetime->format('Y-m-d H:i:s');
		} catch(\Exception $e) {
			return '';
		}
	}

	public static function DTOutBrowser($s_datetime){
		// create a datetime objcet in the local timezone
		global $tz; // import tz from the global something space 
		$datetime = new DateTime($s_datetime, new DateTimeZone('UTC'));
		// change the timezone to UTC
		$datetime->setTimezone(new DateTimeZone($tz));
		// return output to a standard string format
		return $datetime->format('Y-m-d H:i:s');
	}
}