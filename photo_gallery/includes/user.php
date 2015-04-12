<?php
require_once("database.php");
/**
 * User class
 *
 * @author Ankur
 */
class User extends DatabaseObject{
    
    //Every column in users table can be made an attribute
    protected static $table_name = "users";
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    
    
    //Unique functions for the class
    
    //Tis function authenticates a user by checking username and password.
    //Returns an instance of User
    public static function authenticate($username = "", $password = ""){
        global $database;
        
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        
        $query = "SELECT * FROM users ";
        $query .= "WHERE username = '{$username}' ";
        $query .= "AND password = '{$password}' ";
        $query .= "LIMIT 1";
        
        //Fucntion inherited from parent class
        $result_array = self::find_by_sql($query);
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    
    //Returns full name
    public function full_name(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name ." ". $this->last_name;
        }
        else{
            return "";
        }
    }
    
    public function save(){
        //a new record wont have an ID, so we can use that to decide if we wanna update or create
        //Just a convinience function...
        //instead of calling create or update we just call save and let this line of code figure it out.
        
        //This also prevents recreating users by mistake
        return isset($this->id) ? $this->update() : $this->create(); 
    }
    
    //Creates a new user
    protected function create(){
        global $database;
        
        $sql = "INSERT INTO users ";
        $sql .= "( username, password, first_name, last_name )";
        $sql .= "VALUES (";
        $sql .= "'" . $database->escape_value($this->username)   . "',";
        $sql .= "'" . $database->escape_value($this->password)   . "',";
        $sql .= "'" . $database->escape_value($this->first_name) . "',";
        $sql .= "'" . $database->escape_value($this->last_name)  . "')";  
        
        if ($database->query($sql)){
            // if the insert was successful...get the id that was inserted at.
            $this->id = $database->insert_id();
            return true;
        }
        return false;       
    }
    
    //Update existing user
    protected function update(){
        global $database;
        
        //UPDATE users
        //SET column1 = value1, column2 = value2...., columnN = valueN
        //WHERE [condition];      
        $sql = "UPDATE users SET ";
        $sql .= " first_name = '" . $database->escape_value($this->first_name) . "' ," ;
        $sql .= " last_name = '" . $database->escape_value($this->last_name) . "' ," ;
        $sql .= " username = '" . $database->escape_value($this->username) . "' ," ;
        $sql .= " password = '" . $database->escape_value($this->password) . "' " ;
        $sql .= "WHERE id = " . $database->escape_value($this->id);
        $database->query($sql);
        
        if ($database->affected_rows() == 1){
            return true;
        }
        return false;  
    
    }
    
    //Delete existing user  
    public function delete(){
        global $database;
        
        $sql = "DELETE FROM users WHERE ";
        $sql .= "id = ";
        $sql .= "'" . $database->escape_value($this->id) . "' ";  
        $sql .= "LIMIT 1";
        $database->query($sql);
                
        if ($database->affected_rows() == 1){
            return true;
        }
        return false;       
    }
  }

?>
