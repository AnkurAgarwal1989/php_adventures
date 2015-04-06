<?php

class Box {
    //put your code here
    public $cnt = 0;
}

$box1 = new Box();
echo $box1->cnt . "<br />";

echo "<hr>";

$box2 = $box1;
$box2->cnt = 5;
echo $box1->cnt . "<br />";
echo $box2->cnt . "<br />";

echo "<hr>";

$box3 = clone $box1;
$box3->cnt = 15;
echo $box1->cnt . "<br />";
echo $box3->cnt . "<br />";

echo "<hr>";

$box1->cnt = 9;
echo $box1->cnt . "<br />";
echo $box2->cnt . "<br />";



?>