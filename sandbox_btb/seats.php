<?php

$a = "Kevin";
$b = "Mary";
$c = "Jack";
$d = "Don";
$e = "David";

$students = array('a', 'c', 'e');
foreach ($students as $seat) {
    echo $$seat . "<br />";
}

?>
