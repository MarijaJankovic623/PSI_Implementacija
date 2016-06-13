<?php
 class CITest2 extends PHPUnit_Framework_TestCase
  {
    private $CI;
    public function setUp()
    {
		define("TESTING",true);
      // Load CI instance normally
      $this->CI = &get_instance();
    }
    public function testGetPost()
    {
      $this->CI->load->model('UserValidationModel');
	  $rez = $this->CI->UserValidationModel->loginKorisnik("Marko","1234");
      $this->assertEquals(true, $rez);
	  //$env = getenv('ENVIRONMENT');
	  $this->assertEquals(true, TESTING);
    }
  }