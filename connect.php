<?php

// Database config

$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= 'root';
$db_database    = 'todolist';

// End config


$link = @mysql_connect($db_host,$db_user,$db_pass)
    or die('Unable to establish a DB connection');

mysql_set_charset('utf8');
mysql_select_db($db_database,$link);




function get_dolist(){
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "todolist";
    try {
        $db_conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);


        $query = $db_conn->prepare("Select * from tdl_todo order by position ASC");
        
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            
            $todos[] = new ToDo($row);

        }
        return $todos;


        $db = null; // close the database connection

    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}
