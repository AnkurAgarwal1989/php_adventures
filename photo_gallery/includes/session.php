<?php

/**
 * Class to help session work.
 * Manage user loggin in and out.
 *
 * It is NOT advisable to save DB related objects in session
 * @author Ankur
 */
class Session {
    
    private $logged_in = false;
    public $user_id;
    
    function __construct() {
        session_start();
        $this->check_login();
    }
    
    public function is_logged_in(){
        return $this->logged_in;
    }
    
    //DB gives us the user based on username and pwd
    public function login($user){
        if($user){
            //save in session file for future
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;
        }
    }
    
    public function logout(){
        //unset everywhere
        unset($this->user_id);
        unset($_SESSION['user_id']);
        $this->logged_in = false;
    }


    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        }
        else{
            unset($this->user_id);
            $this->logged_in = false;
        }
    }	
}

$session = new Session();

?>
