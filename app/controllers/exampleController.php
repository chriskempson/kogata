<?php
/**
 * Example Controller
 * 
 * An ever so basic controller
 *
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class ExampleController {

	/**
	 * Index
	 * 
	 * Does nothing too exciting
	 *
	 * @return void
	 */
	public function index($name = false) {
		$data = rc::exampleModel()->get();
		rc::template('example', $data);
	}
	
	public function hello($name = false) {
		echo 'Hello '.$name;
	}
	
	private function hidden() {
		echo 'You can\'t see me!';
	}
}