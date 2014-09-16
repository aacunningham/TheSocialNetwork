<?php
/*
 * MySQL Class 
 */

class SQL {
    public $result;
    private $connection;
    private $query;
    private $row;
    
    public function __construct() {
        $user = "user"; //user
        $pass = "password"; //password
        $host = "localhost"; //host
        $db = 'thesocialnetwork'; //databse name
        $this->connection = mysql_pconnect ($host, $user, $pass) or die(mysql_error()); //connect to DB
        mysql_select_db($db,$this->connection) or die(mysql_error()); //select DB
        unset($user);
        unset($pass);
        unset($host);
    }
    
    //query the SQL DB, get an array of results
    public function get ($sql = null, $associative = false) {
        if (isset($sql)) {
            $this->query = mysql_query("$sql", $this->connection) or die(mysql_error()); //send query
            if ($this->query) {
                $this->result = array(); //SQL results
                while ($this->row = $associative ? mysql_fetch_assoc($this->query) : mysql_fetch_array($this->query)) {
                    $this->result[] = $this->row; //build results array
                }
                return $this->result; //if success, return results array
            }
        }
        return false; //return false if failed
    }
    
    //send a command to the SQL DB, return success or, if insert, insert id
    public function send ($sql = null) {
        if (isset($sql)) {
            mysql_query("$sql", $this->connection) or die(mysql_error()); //send sql command
            
            if (strtoupper(substr($sql,0,6)) == "INSERT") { //if inserting
                return mysql_insert_id(); //return insert id
            }
            else return true; //return true for success
        }
        else return false; //return false for failure
    }
    
    //insert into table the columns listed with the values provided, return insert id
    public function insert ($table, $columns, $values) {
        $query = "INSERT INTO ".$table." ("; //build insert command
        foreach ($columns as $c) {
            $query .= $c.", "; //column names
        }
        $query = rtrim ($query, ", "); //remove last comma
        $query .= ") VALUES (";
        foreach ($values as $v) {
            $query .= "'".$v."', "; //values
        }
        $query = rtrim ($query, ", "); //remove last comma
        $query .= ")";
        return $this->send ($query); //send insert command, return insert id
    }
    
    //update in table the columns listed with the values provided where identifier = id, return success true/false
    public function update ($table, $columns, $values, $identifier, $id) {
        $query = "UPDATE ".$table." SET "; //build update command
        $i = 0; //access columns and values concurrently
        foreach ($columns as $c) {
           $query .= $c."='".$values[$i++]."', "; //column='value' pairing
        }
        $query = rtrim ($query, ", "); //remove last comma
        $query .= " WHERE ".$identifier."=".$id; //choose which row to update
        return $this->send ($query); //send update command, return sucess true/false
    }
    
    //delete from table where identifier = id
    public function delete ($table, $identifier, $id) {
        $query = "DELETE FROM ".$table." WHERE ".$identifier."=".$id; //build delete command
        return $this->send($query); //send delete command
    }
    
    public function __destruct() {
        mysql_close($this->connection);
        unset($this->connection);
    }
}
?>