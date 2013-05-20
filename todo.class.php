<?php

/* Defining the ToDo class */

class ToDo{
	
	/* An array that stores the todo item data: */
	
	private $data;
	
	/* The constructor */
	public function __construct($par){
		if(is_array($par))
			$this->data = $par;
	}
	
	/*
		This is an in-build "magic" method that is automatically called 
		by PHP when we output the ToDo objects with echo. 
	*/
		
	public function __toString(){
		
		// The string we return is output by the echo statement
		if ($this->getStatus()==0){
                    $actionDone = '<a href="#" class="notdone">Not Done</a>';
                }
                else{
                    $actionDone = '<a href="#" class="done">done</a>';
                }

		return '
			<li id="todo-'.$this->data['id'].'" class="todo">
			
				<div class="text">'.$this->data['text'].'</div>
				
				<div class="actions">
                                        '.$actionDone.'
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div>
				
			</li>';
	}
        public function outputToDo(){
		// The string we return is output by the echo statement
		if ($this->getStatus()==0){ //we only return to do items
          
		return '
			<li id="todo-'.$this->data['id'].'" class="todo">

				<div class="text">'.$this->data['text'].'</div>

				<div class="actions">
                    <a href="#" class="notdone">Not Done</a>
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div>

			</li>';
                }
	}

        public function outputDone(){
		// The string we return is output by the echo statement
		if ($this->getStatus()!=0){ //we only return done items

		return '
			<li id="todo-'.$this->data['id'].'" class="todo">

				<div class="text">'.$this->data['text'].'</div>
                </li>';
				

			
                }
	}
	//______________________________________
	//______________________________________
	public function getID(){
            return $this->data['id'];
        }
        public function getStatus(){
            return $this->data['status'];
        }
	public function getStatusText(){
            if ($this->data['status']==0){
                return "Not Done";
            }
            else return "Done";
        }
	
	/*
		The edit method takes the ToDo item id and the new text
		of the ToDo. Updates the database.
	*/
	//______________________________________	
	public static function edit($id, $text){
		
		$text = self::esc($text);
		if(!$text) throw new Exception("Wrong update text!");
		
		mysql_query("	UPDATE tdl_todo
						SET text='".$text."'
						WHERE id=".$id
					);
		
		if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("Couldn't update item!");
	}
	
	/*
		The statusupdate method. Updates the status to done.
	*/
	//______________________________________
        public static function updatestatus($id){


		mysql_query("UPDATE tdl_todo SET status= 1 WHERE id=".$id );

		if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("Couldn't update item!");
	}

	/*
		The delete method. Takes the id of the ToDo item
		and deletes it from the database.
	*/
	//______________________________________
	public static function delete($id){
		
		mysql_query("DELETE FROM tdl_todo WHERE id=".$id);
		
		if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("Couldn't delete item!");
	}
	
	/*
		The rearrange method is called when the ordering of
		the todos is changed. Takes an array parameter, which
		contains the ids of the todos in the new order.
	*/
	//______________________________________
	public static function rearrange($key_value){
		
		$updateVals = array();
		foreach($key_value as $k=>$v)
		{
			$strVals[] = 'WHEN '.(int)$v.' THEN '.((int)$k+1).PHP_EOL;
		}
		
		if(!$strVals) throw new Exception("No data!");
		
		// We are using the CASE SQL operator to update the ToDo positions en masse:
		
		mysql_query("	UPDATE tdl_todo SET position = CASE id
						".join($strVals)."
						ELSE position
						END");
		
		if(mysql_error($GLOBALS['link']))
			throw new Exception("Error updating positions!");
	}
	
	/*
		The createNew method takes only the text of the todo,
		writes to the databse and outputs the new todo back to
		the AJAX front-end.
	*/
	//______________________________________
	public static function createNew($text){
		
		$text = self::esc($text);
		if(!$text) throw new Exception("Wrong input data!");
		
		$posResult = mysql_query("SELECT MAX(position)+1 FROM tdl_todo");
		
		if(mysql_num_rows($posResult))
			list($position) = mysql_fetch_array($posResult);

		if(!$position) $position = 1;

		mysql_query("INSERT INTO tdl_todo SET text='".$text."', position = ".$position);

		if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("Error inserting TODO!");
		
		// Creating a new ToDo and outputting it directly:
		
		echo (new ToDo(array(
			'id'	=> mysql_insert_id($GLOBALS['link']),
			'text'	=> $text
		)));
		
		exit;
	}
	
	/*
		A helper method to sanitize a string:
	*/
	//______________________________________
	public static function esc($str){ 
		if(ini_get('magic_quotes_gpc'))
			$str = stripslashes($str);
		return mysql_real_escape_string(strip_tags($str));
	}
	
} // closing the class definition

?>