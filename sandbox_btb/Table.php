<?php

class Table {
    //put your code here
    public $legs;
    static public $total_tables = 0;


    public function __construct($leg_count = 4) {
        Table::$total_tables++;
        $this->legs = $leg_count;
    }
}

$table = new Table();
echo Table::$total_tables;

?>