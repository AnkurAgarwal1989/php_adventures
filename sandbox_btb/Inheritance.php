<?php

class Car {
    //put your class code here  
    
    var $wheels = 4;
    
    var $doors = 4;
    
    function wheels_doors(){
        return $this->wheels . " " . $this->doors . "<br />";
    }
}

class CompactCar extends Car {

}

$car1 = new Car();
$car2 = new CompactCar();

echo $car1->wheels_doors();
echo $car2->wheels_doors();

?>