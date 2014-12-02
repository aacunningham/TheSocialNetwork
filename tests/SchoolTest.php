<?php
require_once '/school/school.php';
require_once '/sql/sql.php';
class SchoolTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $s = new school();
        $s->name = $s->type = $s->address = $s->city = $s->state = $s->major = $s->minor = $s->degree = "Test";
        $s->zipCode = 0;
        $s->startDate = "1901-01-01";
        $s->endDate = "1901-01-01";
        $s->create(1);
        $this->assertFalse(empty($s->get())); 
        $s->delete();
    }

    public function testCreate()
    {
        $s = new school();
        $s->name = $s->type = $s->address = $s->city = $s->state = $s->major = $s->minor = $s->degree = "Test";
        $s->zipCode = 0;
        $s->startDate = $s->endDate = "1901-01-01";
        $this->assertTrue($s->create(1)); 
        $s->delete();
    }

    public function testDelete()
    {
        $s = new school();
        $s->name = $s->type = $s->address = $s->city = $s->state = $s->major = $s->minor = $s->degree = "Test";
        $s->zipCode = 0;
        $s->startDate = $s->endDate = "1901-01-01";
        $s->create(1);
        $this->assertTrue($s->delete()); 
    }

    public function testEdit()
    {
        $s = new school();
        $s->name = $s->type = $s->address = $s->city = $s->state = $s->major = $s->minor = $s->degree = "Test";
        $s->zipCode = 0;
        $s->startDate = $s->endDate = "1901-01-01";
        $s->create(1);
        $this->assertTrue($s->edit()); 
        $s->delete();
    }

    public function testListAll()
    {
        $s = new school();
        $this->assertFalse(empty($s->listAll()));
    }
    
    public function testListSchools()
    {
        $s = new school();
        $this->assertFalse(empty($s->listSchools(1)));
    }

    public function testSortSchools()
    {
        $s = new school();
        $this->assertFalse(empty($s->sortSchools($s->listSchools(1)))); 
    }
    
    public function testDisplay()
    {
        $s = new school();
        $this->assertFalse(empty($s->display(1))); 
    }
}
?>