<?php
/**
 * Session Library
 * 
 * A wrapper around PHP's session functions to aid simplicity of use
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Session {
	
	private $session;

	/**
	 * Constructor
	 * 
	 * Initialises session
	 */
	function __construct() { 
		session_start(); 
		$this->session = $_SESSION;
	}
	
	/**
	 * Set
	 *
	 * @param array/string $var Key Value Array or simple Key
	 * @param string $value Optional Value
	 * @return void
	 */
	function set($var, $value = false) { 
		if (is_array($var)) {
			foreach ($var as $key => $value) 
				$this->session[$key] = $value;
		}
		else $this->session[$var] = $value; 
	}	
	
	/**
	 * Get
	 *
	 * @param string $key 
	 * @return variable
	 */
	function get($key = false) { 
		if ($key) {
			if(isset($this->session[$key])) return $this->session[$key];
			else return false;
		}
		else return $this->session; 
	}
	
	/**
	 * Flash
	 * 
	 * Get session variable and then destroy it
	 *
	 * @param string $key 
	 * @return void
	 */	
	function flash($key = false) { 
		$variable = $this->get($key);
		$this->set($key);
		return $variable;
	}
	
	/**
	 * Destroy
	 * 
	 * Clean entire session
	 *
	 * @return void
	 */
	function destroy() { $_SESSION = null; }
}
?>