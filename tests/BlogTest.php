<?php
require_once '/blog/blog.php';
require_once '/sql/sql.php';
class BlogTest extends PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $b = new blog();
        $b->uid = 1;
        $b->title = "Test";
        $b->content = "Test";
        $b->cid = 1;
        $b->fid = 1;
        $b->create(1);
        $this->assertFalse(empty($b->get())); 
        $b->delete();
    }

    public function testCreate()
    {
        $b = new blog();
        $b->uid = 1;
        $b->title = "Test";
        $b->content = "Test";
        $b->cid = 1;
        $b->fid = 1;
        $this->assertTrue($b->create(1)); 
        $b->delete();
    }

    public function testDelete()
    {
        $b = new blog();
        $b->uid = 1;
        $b->title = "Test";
        $b->content = "Test";
        $b->cid = 1;
        $b->fid = 1;
        $b->create(1);
        $this->assertTrue($b->delete()); 
    }

    public function testEdit()
    {
        $b = new blog();
        $b->uid = 1;
        $b->title = "Test";
        $b->content = "Test";
        $b->cid = 1;
        $b->fid = 1;
        $b->create(1);
        $b->content = "Test1";
        $this->assertTrue($b->edit()); 
        $b->delete();
    }

    public function testListAll()
    {
        $b = new blog();
        $this->assertFalse(empty($b->listAll()));
    }
    
    public function testListBlogs()
    {
        $b = new blog();
        $this->assertFalse(empty($b->listBlogs(1, 1))); 
    }

    public function testSortBlogs()
    {
        $b = new blog();
        $this->assertFalse(empty($b->sortBlogs($b->listBlogs(1, 1)))); 
    }
    
    public function testDisplay()
    {
        $b = new blog();
        $this->assertFalse(empty($b->display(1, 1))); 
    }
}
?>