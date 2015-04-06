<?php
require_once("config.php");;
/**
 * Functions to handle DB operations
 */
class MySQLDatabase {
    
    private $connection;
    
    //Constructor
    function __construct() {
        $this->open_connection();
    }

    //Open DB connection
    public function open_connection(){
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if(mysqli_connect_errno()){
            die("Database connection failed: " . 
                    mysqli_connect_error() . 
                    "( " . mysqli_connect_errno()." )"
            );
        }
    }
    
    public function query($sql_query){
        $result = mysqli_query($this->connection, $this->mysql_prep($sql_query));
        $this->confirm_query($result);        
        //Return the result
        return $result;
    }
    
    //Function to prepare mySQL query.
    public function mysql_prep($string) {
        //Escape special characters...to prevent injection attacks
        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }

    //Function confirms if returned query from SQL is not null...
    //if NULL..dies with an error message
    private function confirm_query($result_set) {
        if (!$result_set) {
            die("Database query failed.");
        }
    }
    
    
    //Close DB connection...if connection exists...
    //Unset the private variable 
    public function close_connection(){
        if (isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    
    
}

$database = new MySQLDatabase;

//Just another reference...we can use either...       
$db =& $database;

?>
