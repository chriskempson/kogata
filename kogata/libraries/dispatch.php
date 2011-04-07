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
		$routes   = rc::route()->routes;
		$method   = rc::request()->method;
		$resource = rc::request()->resource;

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
	 * Checks to see if requested resource matches the supplied pattern
	 *
	 * @param string $patten Resource pattern to match e.g. /users/:name
	 * @param mixed $callable String or array for call_user_func_array()
	 * @param array $params Response from $this->params()
	 */	
	function call($pattern, $callable, $params) {
		if (isset($params[':action']) && strstr($pattern, ':action')) {
			if (is_callable(array($callable[0], $params[':action']))) 
				$callable[1] = $params[':action'];
				unset($params[':action']);
		}
		
		if (is_callable($callable)) {
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
	 * @param string $pattern Resource pattern to match e.g. /users/:name
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
			// Match /
			if (isset($patArray[$i]) && !$patArray[$i]
				&& (isset($resArray[$i]) && !$resArray[$i])) return true;

			if (!isset($patArray[$i]) || !$patArray[$i]) return false;
			
			if (!isset($resArray[$i]) || !$resArray[$i]) return false;
			
			if (!strstr($patArray[$i], ':') 
				&& $patArray[$i] != $resArray[$i]) return false;
		}

		return true;
	}
	
	/**
	 * Params
	 * 
	 * Strips parameters from a resource based on the pattern. For example
	 * grabs $id and $name from /users/:id/:name
	 *
	 * @param string $pattern Resource pattern e.g. /users/:name
	 * @param string $resource Requested resource
	 * @return array
	 */
	public function params($pattern, $resource) {
		$patArray = explode('/', $pattern);
		$resArray = explode('/', $resource);
		$params   = array();
	
		for($i = 1; $i < count($resArray); $i++) {
			if (isset($patArray[$i]) && strstr($patArray[$i], ':')) {
				$params[$patArray[$i]] = $resArray[$i];
			}
		}
		
		return $params;
	}

}
?>