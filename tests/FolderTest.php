<?php
require_once '/folder/folder.php';
require_once '/sql/sql.php';
class FolderTest extends PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $f = new folder();
        $f->name = "Test";
        $f->create(1);
        $this->assertFalse(empty($f->get())); 
        $f->delete();
    }

    public function testCreate()
    {
        $f = new folder();
        $f->name = "Test";
        $this->assertTrue($f->create(1)); 
        $f->delete();
    }

    public function testDelete()
    {
        $f = new folder();
        $f->name = "Test";
        $f->create(1);
        $this->assertTrue($f->delete()); 
    }

    public function testEdit()
    {
        $f = new folder();
        $f->name = "Test";
        $f->create(1);
        $this->assertTrue($f->edit()); 
        $f->delete();
    }

    public function testListAll()
    {
        $f = new folder();
        $this->assertFalse(empty($f->listAll()));
    }
    
    public function testListFolders()
    {
        $f = new folder();
        $this->assertFalse(empty($f->listFolders(1, 1))); 
    }

    public function testSortFolders()
    {
        $f = new folder();
        $this->assertFalse(empty($f->sortFolders($f->listFolders(1, 1)))); 
    }
    
    public function testDisplay()
    {
        $f = new folder();
        $this->assertFalse(empty($f->display(1, 1))); 
    }
}
?>