<?php
/**
 * URL Helper
 * 
 * Provides functions to aid in the creation of URL's and hyperlinks
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 * @link https://github.com/ChrisKempson/Kogata/wiki/Url
 */

/**
 * URL Function
 * 
 * Builds URLs based upon currently dispatched route
 *
 * @param string $link A URL
 * @return string
 */
function url($link = null) {

	if ($link == '$back')
		return (sc::request()->referer 
			? sc::request()->referer : 'javascript:history.back()');
	else if ($link[0] == '/')
		return $link;
	else if (substr($link, 0, 7) == 'http://')
		return $link;
 	else if (defined('dispatched_route'))
		return dispatched_route.'/'.$link;
	else 
		return $link;
}

/**
 * Hyperlink Function
 * 
 * Constructs a hyperlink via the url() function
 *
 * @param string $text The hyperlink's link text
 * @param string $link A URL
 * @return string
 */
function a($text = '', $link = null) {
	
	return '<a href="'.url($link).'">'.$name.'</a>';
}
?>