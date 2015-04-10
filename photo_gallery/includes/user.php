<?php
require_once("database.php");
/**
 * User class
 *
 * @author Ankur
 */
class User extends DatabaseObject{
    
    //Every column in users table can be made an attribute
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
    }
    
    
    //Common functions for the class
    public static function find_all(){
        //This returns an array of user object
        return User::find_by_sql("SELECT * FROM users");
    }
    
    //Returns one row 
    public static function find_by_id($id = 0){
        //This needs to return a single object
        $result_array = User::find_by_sql("SELECT * FROM users where id = {$id} LIMIT 1");
        
        //We need to return first object only...will use array_shift
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    
    public static function find_by_sql($sql = 0){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)){
            $object_array[] = self::instantiate($row);
        }
        //Returns an array
        return $object_array;
    }
    
    
    //func takes a record and assigns right values to the attributes
    private static function instantiate($record){
        $object = new self;
        /*$object->id           = $record['id'];
        $object->username     = $record['username'];
        $object->password     = $record['password'];
        $object->first_name   = $record['first_name'];
        $object->last_name    = $record['last_name'];
        return $object;*/
        
     foreach ($record as $attribute=> $value) {
         if($object ->has_attribute($attribute)){
             $object->$attribute = $value;
         }
     }
     return $object;
    }
    
    private function has_attribute($attribute){
      
        $object_vars = get_object_vars($this);
        return array_key_exists($attribute, $object_vars);
    }
    
}

?>
