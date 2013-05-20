<?php



    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "todolist";
    try {
        $db_conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);


        $query = $db_conn->prepare("Select * from tdl_todo where status = 1 order by position ASC");

        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {

            $dones[] = $row;

        }
  
        $db = null; // close the database connection

    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo "<b>Done Jobs</b><br />";
    echo "_______________________________<br />";

foreach($dones as $done){
    //echo $item->outputDone();
    echo $done["text"]."<br />";
}

?>
