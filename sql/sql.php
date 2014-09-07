<?php
/*
MySQL Class 

Usage:
call new SQL() to establish connection
use function query ($sql, $associative) to query the database and get an array
use function send ($sql) to insert and update the database
*/

class SQL {
    private $connection;
    public $result;
    private $query;
    private $row;
    
    public function __construct() {
        $user = "user";
        $pass = "password";
        $host = "localhost";
        $this->connection = mysql_pconnect ($host, $user, $pass) or die(mysql_error());
        mysql_select_db('database',$this->connection) or die(mysql_error());
        unset($user);
        unset($pass);
        unset($host);
    }
    
    public function query ($sql = null, $associative = false) {
        if (isset($sql)) {
            $this->query = mysql_query("$sql",$this->connection) or die(mysql_error());
            if ($this->query) {
                $this->result = array();
                while ($this->row = $associative ? mysql_fetch_assoc($this->query) : mysql_fetch_array($this->query)) {
                    $this->result[] = $this->row;
                }
                return $this->result;
            }
        }
        return false;
    }
    
    public function send ($sql = null) {
        if (isset($sql)) {
            mysql_query("$sql", $this->connection) or die(mysql_error());
            
            if (strtoupper(substr($m,0,6)) == "INSERT") {
                return mysql_insert_id();
            }
            else return true;
        }
        else return false;
    }
    
    public function __destruct() {
        mysql_close($this->connection);
        unset($this->connection);
    }
}
?>