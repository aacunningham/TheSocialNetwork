<?php
require_once '/post/post.php';
require_once '/sql/sql.php';
class PostTest extends PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $p = new post();
        $p->content = "Test";
        $p->create(1);
        $this->assertFalse(empty($p->get())); 
        $p->delete();
    }

    public function testCreate()
    {
        $p = new post();
        $p->uid = 1;
        $p->content = "Test";
        $this->assertTrue($p->create(1)); 
        $p->delete();
    }

    public function testDelete()
    {
        $p = new post();
        $p->uid = 1;
        $p->content = "Test";
        $p->create(1);
        $this->assertTrue($p->delete()); 
    }

    public function testEdit()
    {
        $p = new post();
        $p->uid = 1;
        $p->content = "Test";
        $p->create(1);
        $p->content = "Test1";
        $this->assertTrue($p->edit()); 
        $p->delete();
    }

    public function testListAll()
    {
        $p = new post();
        $this->assertFalse(empty($p->listAll()));
    }
    
    public function testListPosts()
    {
        $p = new post();
        $this->assertFalse(empty($p->listPosts(1))); 
    }

    public function testSortPosts()
    {
        $p = new post();
        $this->assertFalse(empty($p->sortPosts($p->listPosts(1)))); 
    }
    
    public function testDisplay()
    {
        $p = new post();
        $this->assertFalse(empty($p->display(1))); 
    }
}
?>