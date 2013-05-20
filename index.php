<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>To do list</title>


<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/themes/humanity/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">

</script>

<?php
require "connect.php";
require "todo.class.php";
?>

</head>

<body>

<h1>Ed Kaiser's To Do List</h1><h2></h2>

<?php for($i=1; $i<6; $i++){ echo "<br />";}  //this just adds pleasing spacing  ?> 

<div id="main">

	<ul class="todoList">
		
<?php
	$todos = get_dolist("todo"); // called from connect.php uses pdo to pull list from DB and turn it into an array to ToDo objects
	foreach($todos as $item){
	    echo $item->outputToDo();
	}
                
?>

    </ul>

<a id="addButton" class="green-button" href="#">Add a ToDo</a>



<div id="workDone" align="center" ><b></b></div>
</div>

<!-- This div is used as the base for the confirmation jQuery UI POPUP. Hidden by CSS. -->
<div id="dialog-confirm" title="Delete TODO Item?">Are you sure you want to delete this TODO item?</div>



</body>
</html>
