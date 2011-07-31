<?php
/**
 * Dispatch Library
 * 
 * Executes routes supplied to the Route Library by matching the supplied
 * pattern the resource (URL) and executing the supplied function/method
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Dispatch {

	/**
	 * Constructor
	 * 
	 * Execute any defined routes
	 */
	function __construct() {
		$routes   = sc::route()->routes;
		$method   = sc::request()->method;
		$resource = sc::request()->resource;

		// Check each route
		foreach ($routes[$method] as $route) {
			
			// Do we have a match?
			if ($this->match($route['pattern'], $resource)) {
				$pattern = $route['pattern'];
				$callable = $route['callable'];
				$params = $this->params($route['pattern'], $route['resource']);
				
				// Call the user function
				$this->call($pattern, $callable, $params);
				return;
			}
		}

		// Otherwise call the default route
		$route = end($routes[$method]);
		$this->call(null, $route['callable'], array());
	}

	/**
	 * Call
	 * 
	 * Calls a function or class method
	 *
	 * @param string $patten Resource pattern to match e.g. /users/$name
	 * @param mixed $callable String or array for call_user_func_array()
	 * @param array $params Response from $this->params()
	 */	
	function call($pattern, $callable, $params) {

		if (isset($params['$action']) && strstr($pattern, '$action')) {
			if (is_callable(array($callable[0], $params['$action']))) 
				$callable[1] = $params['$action'];
				unset($params['$action']);
		}
		
		if (is_callable($callable)) {
			
			// Call class loader on strings
			if (is_array($callable) && is_string($callable[0])) 
				$callable[0] = nc::$callable[0]();
				
			// Store the route that has been dispatched
			define('dispatched_route', $this->strip($pattern));	
			
			// Call the user function
			call_user_func_array(
				$callable,
				$params
			);
		}
	}
	
	/**
	 * Match
	 * 
	 * Checks to see if requested resource matches the supplied pattern
	 *
	 * @param string $pattern Resource pattern to match e.g. /users/$name
	 * @param string $resource Requested resource
	 * @return boolean
	 */
	public function match($pattern, $resource) {
		$patArray = explode('/', $pattern);
		$resArray = explode('/', $resource);
		
		// Decide length based on which is the longest array
		if (count($patArray) > count($resArray)) $length = count($patArray);
		else $length = count($resArray);
 
		for($i = 1; $i < $length; $i++) {
			
			// Match "/"
			if (isset($patArray[$i]) && !$patArray[$i]
				&& (isset($resArray[$i]) && !$resArray[$i])) return true;

			// Check if both array elements exist
			if (!isset($patArray[$i]) || !$patArray[$i]) return false;
			if (!isset($resArray[$i]) || !$resArray[$i]) return false;

			// Check for non-variables
			if (!strstr($patArray[$i], '$') 
				&& $patArray[$i] != $resArray[$i]) return false;
		}

		return true;
	}
	
	/**
	 * Params
	 * 
	 * Returns parameters from a resource based on the pattern. For example
	 * grabs $id and $name from "/users/$id/$name"
	 *
	 * @param string $pattern Resource pattern e.g. /users/$name
	 * @param string $resource Requested resource
	 * @return array
	 */
	public function params($pattern, $resource) {
		$patArray = explode('/', $pattern);
		$resArray = explode('/', $resource);
		$params   = array();
	
		for($i = 1; $i < count($resArray); $i++) {
			if (isset($patArray[$i]) && strstr($patArray[$i], '$')) {
				$params[$patArray[$i]] = $resArray[$i];
			}
		}
		
		return $params;
	}
	
	/**
	 * Strip
	 * 
	 * Removes parameters from a resource based on the pattern. For example
	 * "/users/$id/$name" becomes "/users"
	 *
	 * @param string $pattern Resource pattern e.g. /users/$name
	 * @return array
	 */
	public function strip($pattern) {
		$patArray = explode('/', $pattern);
		$array   = null;
	
		foreach ($patArray as $element) {
			if (!strstr($element, '$')) {
				$array[] = $element;
			}
		}

		return implode('/', $array);
	}

}
?>