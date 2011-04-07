<?php
/**
 * Request Library
 * 
 * Simplifies the interaction with browser request data
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Request {

	public $method;
	public $resource;
	private $get;
	private $post;
	private $put;
	private $cookie;
	private $is_ajax;
	
	/**
	 * Constructor
	 *
	 * Gets request data and places it inside class variables
	 */
	public function __construct() {
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->resource = isset($_SERVER['PATH_INFO']) 
			? $_SERVER['PATH_INFO'] : '/';
		$this->get = $_GET;
		$this->post = $_POST;
		$this->put = file_get_contents("php://input");
		$this->cookie = $_COOKIE;
		$this->is_ajax = isset($_SERVER['X_REQUESTED_WITH'])
			&& $_SERVER['X_REQUESTED_WITH'] == 'XMLHttpRequest';
	}
	
	/**
	 * Get
	 * 
	 * Wrapper around $_GET
	 *
	 * @param string $key Identifier
	 * @return variable
	 */
	function get($key = false) { 
		if (isset($this->get[$key])) return $this->get[$key]; 
		if (!$key) return $this->get;
	}
	
	/**
	 * Post
	 * 
	 * Wrapper around $_POST
	 *
	 * @param string $key Identifier
	 * @return variable
	 */	
	function post($key = false) { 
		if (isset($this->post[$key])) return $this->post[$key]; 
		if (!$key) return $this->post;
	}
	
	/**
	 * Put
	 * 
	 * Wrapper around $_PUT
	 *
	 * @param string $key Identifier
	 * @return variable
	 */	
	function put($key = false) { 
		if (isset($this->put[$key])) return $this->put[$key]; 
		if (!$key) return $this->put;
	}
	
	/**
	 * Cookie
	 * 
	 * Wrapper around $_COOKIE
	 *
	 * @param string $key Identifier
	 * @return variable
	 */	
	function cookie() { 
		return $this->cookie;
	}
	
	/**
	 * Is Ajax
	 * 
	 * Returns true if a call has been made via Ajax
	 *
	 * @return bool
	 */	
	function isAjax() { 
		return $this->is_ajax;
	}
}	
?>