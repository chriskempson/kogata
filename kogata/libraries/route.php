<?php
/**
 * Route Library
 * 
 * Provides methods to define routes to be executed by the dispatch library
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Route {
	
	public $routes;
	
	/**
	 * Map
	 * 
	 * Adds a route
	 *
	 * @param string $method GET, POST, PUT or DELETE
	 * @param string $pattern e.g /users/:id:/username
	 * @param string $callable Function or Class Method
	 * @return void
	 */
	public function map($method, $pattern, $callable) {
		$this->routes[strtoupper($method)][] = array(
			'pattern' => $pattern,
			'callable' => $callable,
			'resource' => rc::request()->resource
		);
	}
	
	/**
	 * Get
	 * 
	 * Shortcut for map('GET', ...
	 *
	 * @param string $pattern
	 * @param string $callable 
	 * @return void
	 */
	public function get($pattern, $callable) {
		$this->map('GET', $pattern, $callable);
	}
	
	/**
	 * Post
	 * 
	 * Shortcut for map('POST', ...
	 *
	 * @param string $pattern
	 * @param string $callable 
	 * @return void
	 */	
	public function post($pattern, $callable) {
		$this->map('POST', $pattern, $callable);
	}
	
	/**
	 * Put
	 * 
	 * Shortcut for map('PUT', ...
	 *
	 * @param string $pattern
	 * @param string $callable 
	 * @return void
	 */	
	public function put($pattern, $callable) {
		$this->map('PUT', $pattern, $callable);
	}
	
	/**
	 * Delete
	 * 
	 * Shortcut for map('DELETE', ...
	 *
	 * @param string $pattern
	 * @param string $callable 
	 * @return void
	 */
	public function delete($pattern, $callable) {
		$this->map('DELETE', $pattern, $callable);
	}
}