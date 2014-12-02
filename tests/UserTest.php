<?php
require_once '/user/user.php';
require_once '/sql/sql.php';
class UserTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $u->create();
        $this->assertFalse(empty($u->get())); 
        $u->delete();
    }

    public function testCreate()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $this->assertTrue($u->create()); 
        $u->delete();
    }
    
    public function testUpdatePassword ()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $u->create();
        $this->assertTrue($u->update_password($u->uid)); 
        $u->delete();
    }

    public function testDelete()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $u->create();
        $this->assertTrue($u->delete()); 
    }
    
    public function testLogin ()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $u->create();
        $this->assertTrue($u->login()); 
        $u->delete();
    }
    
    public function testLogout ()
    {
        $u = new user(true);
        $this->assertTrue($u->logout()); 
    }

    public function testForgotPassword ()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $u->create();
        $this->assertTrue($u->forgot_password()); 
        $u->delete();
    }
    
    public function testGetChallengeQuestion ()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $u->create();
        $this->assertFalse(empty($u->get_challenge_question())); 
        $u->delete();
    }
    
    public function testEdit()
    {
        $u = new user(true);
        $u->password = $u->email = $u->fname = $u->lname = $u->interests = $u->hobbies = $u->bio = $u->rel = $u->privacy = "Test";
        $u->create();
        $this->assertTrue($u->edit()); 
        $u->delete();
    }

    public function testListAll()
    {
        $u = new user(true);
        $this->assertFalse(empty($u->listAll()));
    }

    public function testDisplay()
    {
        $u = new user(true);
        $this->assertFalse(empty($u->display(1))); 
    }
}
?>