<?php

require_once '../phpunit/Test/_testSupport/fixtureSupport.php';
require_once '../user/user.php';

class userTest extends fixtureDbTest
{
    public function testLogin(){
        $db = new SQL();
        $u = new user($db);
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
        $db = new SQL();
        $u = new user($db);
        $_SESSION = $sessionAfterLogin;
        
        $this->assertTrue($u->loggedIn());
    }
    
    /**
     *  This really just tests the update password function params
     *  It still needs integration testing with the SQL class
     */
    public function testUpdatePassword(){
        $uid = 1;
        $new_password = 'password';        
        $expected_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $columns = array('password');
        $values = array($expected_password_hash);
        $mockDb = \Mockery::mock('SQL');
        $mockDb->shouldReceive('update')
                ->with('users', $columns, $values, 'uid', $uid)
                ->once()
                ->andReturn(TRUE);
        
        $u = new user($mockDb);       
        $this->assertTrue($u->update_password($uid, $expected_password_hash, $mockDb));
    }
    
    public function testCreate(){
        $columns = array ("password", "email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel", "privacy");
        $values = array ("test","test","test","test","test","test","test","test","test","test");
        $uid = 1;
        
        $mockDb = \Mockery::mock('SQL');
        $mockDb ->shouldReceive('insert')
                ->with("users", $columns, $values)
                ->once()
                ->andReturn($uid);
                
        $mockUser = \Mockery::mock('user[create_default]',array($mockDb));
        $mockUser->shouldReceive('create_default')
                 ->with($uid)
                 ->andReturn(true);
        
        $mockUser->password = $mockUser->email = $mockUser->fname = $mockUser->lname = $mockUser->picture = $mockUser->interests = $mockUser->hobbies = $mockUser->bio = $mockUser->rel = $mockUser->privacy = "test";
             
        $this->assertTrue($mockUser->create());
    }
}
