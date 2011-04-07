<?php
/**
 * Example Model
 *
 * An ever so simple model
 * 
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class ExampleModel {

	/**
	 * Get
	 *
	 * Normally you would interface with your database but for the simplicity of
	 * this example we don't!
	 */
	public function get() {
		$data['title'] = 'Example';
		$data['body'] = 'Visit the <a href="example/hello/kogata">hello method</a>';
		return $data;
	}
}
?>