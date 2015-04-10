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
    
    
    //func takes a record and assigns right values to the attributes
    private static function instantiate($record){
        $object = new static;
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
