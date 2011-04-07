<?php
/**
 * Cache Library
 * 
 * A simple PHP Cache
 *
 * @package Phurb <http://phurb.com>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Cache {
	
	var $path;

	public function __construct() {
		$this->path = (defined('cache_path') ? cache_path : 'tmp/cache');
	}
	
	public function create($name, $data) {		
		if ($fp = fopen($this->file($name), 'w')) {
			fputs($fp, serialize($data));
			fclose($fp);
			return $data;
		} else die('Could not write to cache file: '.$this->file($name));
	}
	
	public function expired($name, $seconds = null) {
		// Don't expire if no expiry time is supplied
		if ($seconds === null) return false;
		
		// Expire if the file does not exist
		if (!file_exists($this->file($name))) return true;
		
		// Expire if the age of the cache is greater than that of the expiry time
		if (filemtime($this->file($name)) <= (time() - $seconds)) return true;
	}

	public function get($name) {
		return unserialize(file_get_contents($this->file($name)));
	}

	public function purge($name) {
		if (file_exists($this->file($name))) return unlink($this->file($name));
		else return false;
	}
	
	public function age($name) {
		return filemtime($this->file($name));
	}
	
	public function headers($name, $seconds = null) {
		$offset = $this->age($name) + $seconds;
		header('Expires: '.gmdate('D, d M Y H:i:s', $offset).' GMT');
		header('Cache-Control: max-age='.$seconds.', must-revalidate');
	}
	
	
	private function file($name) {
		return $this->path.'/'.$name.'.cache';
	}
	
}
?>