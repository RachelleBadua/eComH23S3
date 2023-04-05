<?php 
namespace app\core;

use IntlDateFormatter;
// use statement, does not care of place of file, just needs to find i 

class TimeHelper{
	public static function DTOuput($s_datetime){
		$datetime = new DateTime($s_datetime);
		// TODO: pick the timezone
		$timezone='UTC';
		global $lang;
		$fmt = new IntlDateFormatter(
			$lang,
			// IntlDateFormatter::LONG, // IntlDateFormatter::MEDIUM, // IntlDateFormatter::SHORT
			IntlDateFormatter::MEDIUM, // date format
			IntlDateFormatter::MEDIUM, // time format
			$timezone
		);
		return $fmt->format($datetime);
	}
}