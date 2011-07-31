<?php
/**
 * URL Helper
 * 
 * Builds URL based upon currently dispatched route
 *
 * @param string $format http://php.net/manual/en/function.date.php
 * @param string $datetime Existing datetime
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

function a($name = '', $link = null) {
	
	return '<a href="'.url($link).'">'.$name.'</a>';
}
?>