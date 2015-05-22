<?php
/**
 * DatabaseObject:
 * A generic class that will be extended to transact with respective database tables
 *
 * @author Ankur
 */
require_once(LIB_PATH.DS.'database.php');

class DatabaseObject {
    
    //Common functions for the class
    public static function find_all(){
        //This returns an array of user object
        //The table name attr is being used here
        //The statis keyword is for Late Static Binding...
        //This allows us to use the child class instead of parent class
        return static::find_by_sql("SELECT * FROM " . static::$table_name);
    }
    
    //Returns one row 
    public static function find_by_id($id = 0){
        //This needs to return a single object
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " where id = {$id} LIMIT 1");
        
        //We need to return first object only...will use array_shift
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    
    public static function find_by_sql($sql = 0){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)){
            $object_array[] = static::instantiate($row);
        }
        //Returns an array
        return $object_array;
    }
    
//    public function save(){
//        //a new record wont have an ID, so we can use that to decide if we wanna update or create
//        //Just a convinience function...
//        //instead of calling create or update we just call save and let this line of code figure it out.
//        
//        //This also prevents recreating users by mistake
//        return isset(static::$id) ? static::update() : static::create(); 
//    }
//    
//    public static function create(){
//        global $database;
//        
//        $attr = $this->clean_attributes();
//        
//        $sql = "INSERT INTO " . static::$table_name . " ( ";
//        $sql .= join(", ", array_keys($attr));
//        //$sql .= "username, password, first_name, last_name";
//        $sql .= " ) VALUES ('";
//        /*$sql .= "'" . $database->escape_value($this->username)   . "',";
//        $sql .= "'" . $database->escape_value($this->password)   . "',";
//        $sql .= "'" . $database->escape_value($this->first_name) . "',";
//        $sql .= "'" . $database->escape_value($this->last_name)  . "')";*/ 
//        $sql .= join("', '", array_values($attr));
//        $sql .= "' )";
// 
//        if ($database->query($sql)){
//            // if the insert was successful...get the id that was inserted at.
//            $this->id = $database->insert_id();
//            return true;
//        }
//        return false;       
//    }
//    
//    public static function update(){
//        global $database;
//        
//        $class_name = get_called_class();
//        
//         $attr = $this->clean_attributes();
//         $pairs = array();
//         foreach ($attr as $key => $value) {
//            $pairs[] = "{$key}='{$value}'";
//        }
//         
//        //UPDATE users
//        //SET column1 = value1, column2 = value2...., columnN = valueN
//        //WHERE [condition];      
//        $sql = "UPDATE " . static::$table_name . " SET ";
//        $sql .= join(", ", $pairs);
//        $sql .= " WHERE id = " . $database->escape_value($class_name->$id);
//        $database->query($sql);
//        
//        if ($database->affected_rows() == 1){
//            return true;
//        }
//        return false;  
//    
//    }
//    
//    //Delete existing user  
//    public static function delete(){
//        global $database;
//        $class_name = get_called_class();
//        
//        $sql = "DELETE FROM " . static::$table_name . " WHERE ";
//        $sql .= "id = ";
//        $sql .= "'" . $database->escape_value($class_name->$id) . "' ";  
//        $sql .= "LIMIT 1";
//        $database->query($sql);
//                
//        if ($database->affected_rows() == 1){
//            return true;
//        }
//        return false;       
//    }
    
    
    //func takes a record and assigns right values to the attributes
    private static function instantiate($record){
        $object = new static;
          
        foreach ($record as $attribute=> $value) {
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    
    private function has_attribute($attribute){
      
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars);
    }
    
    private function attributes(){
        //returns array of object attributes keys and their values
        return get_object_vars($this);
    }
    
    //This escaspes the attributes so that we can use in SQL queries.
    private function clean_attributes(){
        global $database;
        $attributes = $this->attributes();
        $clean_attributes = array();
        foreach (attributes as $value) {
            $clean_attributes[] = $database->escape_value($value);
        }
        return $clean_attributes;
    }
}
