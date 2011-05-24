<?php
/**
 * Cookie Library
 * 
 * A wrapper around PHP's cookie functions to aid simplicity of use
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Cookie {
	
	/**
	 * Set Cookie
	 *
	 * @param string $name The name of the cookie
	 * @param string $value The value of the cookie
	 * @param int $expire The time the cookie expires (Unix Timestamp)
	 * @param string $path The path on the server in which the cookie will be 
	 *        available on
	 * @param string $domain The domain that the cookie is available to
	 * @param bool $secure Indicates that the cookie should only be transmitted 
	 *        over a secure HTTPS connection from the client
	 * @param bool $httponly When TRUE the cookie will be made accessible only 
	 *        through the HTTP protocol
	 * @return bool If output exists prior to calling this function, setcookie() 
	 *         will fail and return FALSE. If setcookie() successfully runs, it 
	 *         will return TRUE. This does not indicate whether the user accepted 
	 *         the cookie.
	 */
	public function set(
		$name, $value, $expire = 0, $path = null, $domain = null, $secure = false, 
		$httponly = false
		){ 
		return setcookie(
			$name, $value, $expire, $path, $domain, $secure, $httponly
			);
	}	

	/**
	 * Get Cookie
	 *
	 * @param string $name Cookie name
	 * @return void
	 */
	public function get($name) { 
		if (isset($_COOKIE[$name])) return $_COOKIE[$name]; 
	}
	
	/**
	 * Destroy Cookie
	 *
	 * @param string $name Cookie name
	 * @return void
	 */
	public function destroy($name) { setcookie($name, '', time() - 60); }
}
?>