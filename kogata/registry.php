<?php
/**
 * Registry
 *
 * Singleton registry class
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class rg {
	private static $instance;
	private static $store;
	
	public static function instance() {
		if (!isset(self::$instance)) self::$instance = new self();
		return self::$instance;
	}
	
	public static function get($key) {
		if (!isset(self::$store[$key])) return false;
		return self::$store[$key];
	}
	
	public static function set($key, $value) {
		return self::$store[$key] = $value;
	}
}
?>