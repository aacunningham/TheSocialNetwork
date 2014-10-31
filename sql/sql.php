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
        $user = "root"; //user - root
        $pass = "Aug3!"; //password - Aug3!
        $host = "localhost"; //host - http://ec2-54-209-77-158.compute-1.amazonaws.com/
        $db = 'thesocialnetwork'; //databse name - thesocialnetwork
        
        $this->connection = mysql_pconnect ($host, $user, $pass) or die(mysql_error()); //connect to DB
        mysql_select_db($db,$this->connection) or die(mysql_error()); //select DB
       
        unset($user);
        unset($pass);
        unset($host);
    }
    
    public function get ($sql = null, $associative = false) { //query the SQL DB, get an array of results
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
    
    public function send ($sql = null) { //send a command to the SQL DB, return success or, if insert, insert id
        if (isset($sql)) {
            mysql_query("$sql", $this->connection) or die(mysql_error()); //send sql command
            
            if (strtoupper(substr($sql,0,6)) == "INSERT") { //if inserting
                return mysql_insert_id(); //return insert id
            }
            else return true; //return true for success
        }
        else return false; //return false for failure
    }
    
    public function select ($table, $identifier, $id, $orderby=null) { //select fxn - return all column values from the table where identifier = id
        $query = "SELECT * FROM ".$table." WHERE "; //build query
        if (is_array($identifier) and is_array($id)) { //if multiple conditions
            $i = 0;
            foreach ($identifier as $col) {
                $query .= $col."='".$id[$i]."'"; //add to query
                if (array_key_exists(++$i, $id)) { //if more
                    $query .= " AND "; //add an and
                }
            }
        } else {
            $query .= $identifier."='".$id."'"; //single condition
	}
	if (!empty($orderby)) {
	    $query .= " ORDER BY $orderby";
	}
        return $this->get($query); //send query, return results
    }
	
	public function select_inner( $left_table, $right_table, $left_identifier, $right_identifier ) { //select with inner join - return all column values from left and right tables where $left_ident == $right_ident
    	//incomplete function
    	$left_identifier = $left_table.".".$left_identifier;
		$right_identifier = $right_table.".".$right_identifier;
    	$query = "SELECT * FROM ".$left_table." INNER JOIN ".$right_table." ON ".$left_identifier."=".$right_identifier;
		return $this->get($query);
	}
    public function selectAll ($table) { //select all rows and columns from a given table
        $query = "SELECT * FROM ".$table; //select everything
        return $this->get($query); //return results of query
    }
    
    public function insert ($table, $columns, $values) { //insert into table the columns listed with the values provided, return insert id
        $check = $this->select ($table, $columns, $values); //check if this exact row already exists
        if ($check) return; //if so, don't do anything - avoid duplicate entries
    
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
    
    public function update ($table, $columns, $values, $identifier, $id) { //update in table the columns listed with the values provided where identifier = id, return success true/false
        $query = "UPDATE ".$table." SET "; //build update command
        $i = 0; //access columns and values concurrently
        foreach ($columns as $c) {
           $query .= $c."='".$values[$i++]."', "; //column='value' pairing
        }
        $query = rtrim ($query, ", "); //remove last comma
        $query .= " WHERE ".$identifier."=".$id; //choose which row to update
        return $this->send ($query); //send update command, return sucess true/false
    }
    
    public function delete ($table, $identifier, $id) { //delete from table where identifier = id
        $query = "DELETE FROM ".$table." WHERE "; //build query
        if (is_array($identifier) and is_array($id)) { //if multiple conditions
            $i = 0;
            foreach ($identifier as $col) {
                $query .= $col."='".$id[$i]."'"; //add to query
                if (array_key_exists(++$i, $id)) { //if more
                    $query .= " AND "; //add an and
                }
            }
        } else {
            $query .= $identifier."=".$id; //single condition
        }
        return $this->send($query); //send delete command
    }
    
    public function __destruct() { //destroy SQL connection
        mysql_close($this->connection);
        unset($this->connection);
    }
}
?>
