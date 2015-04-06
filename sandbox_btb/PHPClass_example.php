<?php

class Person {
    //put your class code here  
    
    var $first_name;
    var $last_name;
    
    var $arm_cnt = 2;
    var $leg_cnt = 2;
    
    function say_hello(){
        echo "Hello from inside the " . get_class($this) . " class. <br/>";
    }
    
    function full_name(){
        return $this->first_name . " " . $this->last_name . "<br />";
    }
    
    function hello(){
        $this->say_hello();
    }
}

$person1 = new Person();
$person1->hello();
echo $person1->arm_cnt . "<br />";
$person1->first_name = "Barry";
$person1->last_name = "Allen";
echo $person1->full_name();

?>