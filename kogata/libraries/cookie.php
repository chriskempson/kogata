<?php
/**
 * Cookie Library
 * 
 * A wrapper around PHP's cookie functions
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Cookie {

	/**
	 * Get Cookie
	 *
	 * @param string $name Cookie name
	 * @return void
	 */
	public function getCookie($name) { 
		if (isset($_COOKIE[$name])) return $_COOKIE[$name]; 
	}
	
	/**
	 * Destroy Cookie
	 *
	 * @param string $name Cookie name
	 * @return void
	 */
	public function destroyCookie($name) { setcookie($name, '', time() - 60); }
}
?>