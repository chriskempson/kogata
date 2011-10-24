<?php
/**
 * Loader
 * 
 * Simplifies class loading
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 * @link https://github.com/ChrisKempson/Kogata/wiki/Loader
 */

/**
 * Autoload
 *
 * PHP5 class autoloading
 */
spl_autoload_register('autoload');
function autoload($class) {
	foreach (explode(',', class_paths) as $path) {
		set_include_path(trim($path));
		spl_autoload($class);
	}
}

/**
 * Instantiate
 *
 * Instantiates a class
 */
function instantiate($class, $params) {
	if (!$params) return new $class;               // - Instantiate new class
	$reflection = new ReflectionClass($class);     // - Use reflection class
	return $reflection->newInstanceArgs($params);  //   for class with params
}

/**
 * New Class
 *
 * Returns an new instantiated class
 */
class nc {
	public static function __callStatic($class, $params) {
		return instantiate($class, $params);
	}
}

/**
 * Stored Class
 *
 * Stores or retrieves a class in the registry
 */
class sc {
	public static function __callStatic($class, $params) {
		if (rg::get($class)) return rg::get($class);
		else return rg::set($class, instantiate($class, $params));
	}
}

/**
 * Delete Class
 *
 * Deletes a class previous stored in the registry
 */
class dc {
	public static function __callStatic($class, $params) {
		return rg::set($class, null);
	}
}
?>