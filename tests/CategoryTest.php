<?php
require_once '/category/category.php';
require_once '/sql/sql.php';
class CategoryTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $c = new category();
        $c->name = "Test";
        $c->create();
        $this->assertFalse(empty($c->get())); 
        $c->delete();
    }

    public function testCreate()
    {
        $c = new category();
        $c->name = "Test";
        $this->assertTrue($c->create()); 
        $c->delete();
    }

    public function testDelete()
    {
        $c = new category();
        $c->name = "Test";
        $c->create();
        $this->assertTrue($c->delete()); 
    }

    public function testEdit()
    {
        $c = new category();
        $c->name = "Test";
        $c->create();
        $this->assertTrue($c->edit()); 
        $c->delete();
    }

    public function testListAll()
    {
        $c = new category();
        $this->assertFalse(empty($c->listAll()));
    }

    public function testSortCategories()
    {
        $c = new category();
        $this->assertFalse(empty($c->sortCategories($c->listAll()))); 
    }
    
    public function testDisplay()
    {
        $c = new category();
        $this->assertFalse(empty($c->display())); 
    }
}
?>