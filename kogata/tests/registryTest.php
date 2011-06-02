<?php
require_once '../registry.php';

class RegistryTest extends PHPUnit_Framework_TestCase {

	public function testSettingRegistryVariable() {
		return rg::set('testSet', 'string');
	}

	public function testGettingRegistyVariable() {
		rg::set('testGet', 'string');
		$reg_var = rg::get('testGet');
		$this->assertEquals($reg_var, 'string');
	}
	
	public function testDestroyingRegistyVariable() {
		rg::set('testDestroy', 'string');
		$reg_var = rg::get('testGet');
		$this->assertEquals($reg_var, 'string');
	}
}
?>