<?php

class Person {
    //put your class code here   
}

//Shows all classes declared
//$classes = get_declared_classes();
//foreach ($classes as $class) {
//    echo $class . "<br />";
//}

//check if a class exists
if (class_exists("Person")){
    echo "Class Exists";
}
else{
    echo "Class Does not exist";
}
?>