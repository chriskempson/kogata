<?php
require_once 'PHPUnit/Extensions/OutputTestCase.php';
require_once '../libraries/template.php';
define('views_path', 'resources');

class TemplateTest extends PHPUnit_Extensions_OutputTestCase {
	
	public function testRenderPlainTemplate() {
		$this->tpl = new Template('plain');
		$this->tpl->path = 'resources';
		$this->expectOutputString('Test');
	}
	
	public function testRenderTemplateWithVariables() {
		$variables['one'] = 'One';
		$variables['two'] = 'Two';
		$variables['three'] = 'Three';
		
		$this->tpl = new Template('variables', $variables);
		$this->tpl->path = 'resources';
		$this->expectOutputString('One, Two, Three');
	}
	
}
?>