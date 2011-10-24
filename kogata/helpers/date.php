<?php
/**
 * Date Helper
 * 
 * Provides a function to help deal with datetimes
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 * @link https://github.com/ChrisKempson/Kogata/wiki/Date
 */

/**
 * Datetime
 * 
 * Similar to PHP's date function but with the datetime format
 *
 * @param string $format http://php.net/manual/en/function.date.php
 * @param string $datetime Existing datetime
 * @return void
 */
function datetime($format = false, $datetime = false) {
	if (!$format && !$timestamp) return date('Y-m-d H:i:s', time());
	if (!$datetime) return false;

	if (strstr(' ', $datetime)) {
		list($date, $time)            = explode(' ', $datetime);
		list($year, $month, $day)     = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);
	} else {
		list($year, $month, $day) = explode('-', $datetime);
		$hour = $minute = $second = 0;
	}
	$timestamp = mktime(
		(int)$hour,
		(int)$minute, 
		(int)$second,
		(int)$month,
		(int)$day,
		(int)$year
	);
	return date($format, $timestamp);
}
?>