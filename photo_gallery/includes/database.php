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
