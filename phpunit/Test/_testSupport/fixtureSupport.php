<?php
//namespace phpunit\userTest;

//many files are in the global namespace so add '\' to many names/functions ... =/
//use user\user;	//namespace of file being tested
//use \PDO;

class fixtureDbTest extends \PHPUnit_Extensions_Database_TestCase
{
    //list of the xml files to use for this test file
    public $fixtures = array(
        'userfixture',
    );
    
    private $conn = null;
    
    public function getConnection() {
        if ($this->conn === null) {
            try {
                //$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'Aug3!');
                $pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
                $this->conn = $this->createDefaultDBConnection($pdo, 'test');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $this->conn;
    }
    
    //load all datasets from the fixtures list
    public function getDataSet($fixtures = array()) {
        if (empty($fixtures)) {
            $fixtures = $this->fixtures;
        }
        $compositeDs = new
        PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
        $fixturePath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '_testFixtures';   //to go up to the parent parent (grandparent) folder
        //$fixturePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'fixtures';
     
        foreach ($fixtures as $fixture) {
            $path =  $fixturePath . DIRECTORY_SEPARATOR . "$fixture.xml";
            $ds = $this->createMySQLXMLDataSet($path);
            $compositeDs->addDataSet($ds);
        }
        return $compositeDs;
    }
    
    public function loadDataSet($dataSet) {
        $this->getDatabaseTester()->setDataSet($dataSet);
        $this->getDatabaseTester()->onSetUp();
    }

    public function setUp(){
        $conn = $this->getConnection();
        $pdo = $conn->getConnection();
        
        //set up tables
        $fixtureDataSet = $this->getDataSet($this->fixtures);
        foreach( $fixtureDataSet->getTableNames() as $table) {
            //drop table
            $pdo->exec("DROP TABLE IF EXISTS `$table`;");
            
            //recreate table
            $meta = $fixtureDataSet->getTableMetaData($table);
            $create = "create table if not exists `$table`";
            $cols = array();
            foreach( $meta->getColumns() as $col) {
                $cols[] = "`$col` varchar(200)";
            }
            $create .= '('.implode(',',$cols).');';
            $pdo->exec($create);
        }
        
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
        parent::setUp();
    }
    
    
    public function tearDown() {
        $allTables =
        $this->getDataSet($this->fixtures)->getTableNames();
        foreach ($allTables as $table) {
            // drop table
            $conn = $this->getConnection();
            $pdo = $conn->getConnection();
            $pdo->exec("DROP TABLE IF EXISTS `$table`;");
        }
        $_SESSION = null;
        parent::tearDown();
    }

	/*public function testReadDatabase(){
	    $conn = $this->getConnection()->getConnection();
        
        //read data
        $query = $conn->query('SELECT * FROM users');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(3, count($results));
        
        //delete them
        $conn->query('TRUNCATE users');
        
        $query = $conn->query('SELECT * FROM users');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(0, count($results));
        
        //reload the dataset
        $ds = $this->getDataSet(array('userfixture'));
        $this->loadDataSet($ds);
        
        $query = $conn->query('SELECT * FROM users');
        //$results = $query->fetchAll(PDO::FETCH_COLUMN);
        $results = $query->fetchAll();
        $this->assertEquals(3, count($results));
        
        //print_r($results);
	}*/
}
