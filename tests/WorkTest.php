<?php
require_once '/work/work.php';
require_once '/sql/sql.php';
class WorkTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $w = new work();
        $w->company = $w->position = $w->address = $w->city = $w->state = $w->boss = $w->duties = $w->phone = "Test";
        $w->zipCode = 0;
        $w->startDate = "1901-01-01";
        $w->endDate = "1901-01-01";
        $w->create(1);
        $this->assertFalse(empty($w->get())); 
        $w->delete();
    }

    public function testCreate()
    {
        $w = new work();
        $w->company = $w->position = $w->address = $w->city = $w->state = $w->boss = $w->duties = $w->phone = "Test";
        $w->zipCode = 0;
        $w->startDate = "1901-01-01";
        $w->endDate = "1901-01-01";
        $this->assertTrue($w->create(1)); 
        $w->delete();
    }

    public function testDelete()
    {
        $w = new work();
        $w->company = $w->position = $w->address = $w->city = $w->state = $w->boss = $w->duties = $w->phone = "Test";
        $w->zipCode = 0;
        $w->startDate = "1901-01-01";
        $w->endDate = "1901-01-01";
        $w->create(1);
        $this->assertTrue($w->delete()); 
    }

    public function testEdit()
    {
        $w = new work();
        $w->company = $w->position = $w->address = $w->city = $w->state = $w->boss = $w->duties = $w->phone = "Test";
        $w->zipCode = 0;
        $w->startDate = "1901-01-01";
        $w->endDate = "1901-01-01";
        $w->create(1);
        $this->assertTrue($w->edit()); 
        $w->delete();
    }

    public function testListAll()
    {
        $w = new work();
        $this->assertFalse(empty($w->listAll()));
    }
    
    public function testListWorks()
    {
        $w = new work();
        $this->assertFalse(empty($w->listWorks(1)));
    }

    public function testSortWorks()
    {
        $w = new work();
        $this->assertFalse(empty($w->sortWorks($w->listWorks(1)))); 
    }
    
    public function testDisplay()
    {
        $w = new work();
        $this->assertFalse(empty($w->display(1))); 
    }
}
?>