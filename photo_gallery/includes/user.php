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
    public static function authenticate($username = "", $password = ""){
        global $database;
        
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        
        $query = "SELECT * FROM users ";
        $query .= "WHERE username = '{$username}' ";
        $query .= "AND password = '{$password}' ";
        $query .= "LIMIT 1";
        
        $result_array = self::find_by_sql($query);
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    
    public function full_name(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name ." ". $this->last_name;
        }
        else{
            return "";
        }
    }}
?>
