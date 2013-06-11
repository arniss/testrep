<?php
/**
 * @group App
 * @expectedException PHPUnit_Framework_Error
 */
//require_once("PHPUnit/Autoload.php");
////require_once("PHPUnit/Framework/TestCase.php");
//require_once("PHPUnit/Framework/TestSuite.php");
class Test_Controller_Users extends PHPUnit_Framework_TestCase
{
	public function test_action_logout()
	{
            include 'not_existing_file.php';
	}

	public function test_action_register()
	{
	}

	public function test_action_login()
	{
	}

}
