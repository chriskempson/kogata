<?php
require_once '../libraries/session.php';

class SessionTest extends PHPUnit_Framework_TestCase {

	function setUp() {
      $this->sess = new Session();
  }

  function tearDown() {
      unset($this->sess);
  }
	
	public function testSettingSessionVar() {
		$sess_var = $this->sess->set('test', 'string');
		$this->assertNull($sess_var);
	}
	
	public function testGettingSessionVar() {
		// Set and get
		$this->sess->set('test', 'string');
		$sess_var = $this->sess->get('test');
		$this->assertEquals($sess_var, 'string');
		
		// Clear and get
		$sess_var = $this->sess->set('test');
		$this->assertNull($sess_var);
	}
	
	public function testFlashingSessionVar() {
		$this->sess->set('test', 'string');
		$sess_var = $this->sess->flash('test');
		$this->assertEquals($sess_var, 'string');
		
		$sess_var = $this->sess->flash('test');
		$this->assertNull($sess_var);
	}

	public function testDestroyingSession() {
		$this->sess->set('test', 'string');
		$sess_var = $this->sess->flash('test');
		$this->assertEquals($sess_var, 'string');
		
		$sess_var = $this->sess->destroy();
		$this->assertNull($sess_var);
	}
	
}
?>