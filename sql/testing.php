<?php

    require_once "sql.php";

    $dao = new SQL ();
    
    //$query = "INSERT INTO users (uid, fname, lname, email, password)";
    //$query .= " VALUES ";
    //$query .= "('0', 'Jennifer', 'Garner', 'jennifergarner@mail.fresnostate.edu', 'password')";
    
    //$dao->send ($query); //works
    
    
    //$columns = array ("uid", "fname", "lname", "email", "password");
    //$values = array ("1", "John", "Galley", "jgsniper@gmail.com", "password2");
    //$dao->insert ('users', $columns, $values); //works

    //$query = "DELETE FROM users WHERE uid=0";
    //$dao->send($query); //works
    
    //$query = "UPDATE users SET password='password2', fname='Jenni' WHERE uid=0";
    //$dao->send($query); //works

    //$dao->update ('users', $columns, $values, 'uid', 1); //works

    //$dao->delete ('users', 'uid', '1');  //works














?>