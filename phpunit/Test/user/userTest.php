<?php

require_once '../phpunit/Test/_testSupport/fixtureSupport.php';
require_once '../user/user.php';

class userTest extends PHPUnit_Framework_TestCase
{
    public function setUp(){
          if (!isset($_SESSION))
          {
             // If we are run from the command line interface then we do not care
             // about headers sent using the session_start.
             if (PHP_SAPI === 'cli')
             {
                $_SESSION = array();
                $this->assertTrue(TRUE);
             }
             elseif (!headers_sent())
             {
                if (!session_start())
                {
                   throw new Exception(__METHOD__ . 'session_start failed.');
                }
             }
             else
             {
                throw new Exception(
                   __METHOD__ . 'Session started after headers sent.');
             }
          }
          print_r($_SESSION);
    }
    
    public function tearDown(){
        $_SESSION = null;
    }
    
    public function testLogin(){
        $u = new user();
        $password = 'password';
        $passwordHash = '$2y$10$dFa0flATAN5/s2VCLvSpsO0FU1fsMMRrj2DO9KXm328OWrqFshLui';
        $uid = 2;
        $expectedResult = $uid;
        
        $u->login( $password, $passwordHash, $uid);
        $this->assertEquals($expectedResult, $_SESSION['uid'], 'Did not set $_SESSION uid');
        
        return $_SESSION;
        //return $sessionAfterTestLogin;
    }
    
    /**
     * @depends testLogin 
     */
    public function testLoggedIn(array $sessionAfterLogin){
        $u = new user();
        $_SESSION = $sessionAfterLogin;
        
        $this->assertTrue($u->loggedIn());
    }
}
