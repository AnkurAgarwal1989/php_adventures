<?php

$file = 'filetest.txt';
if ($handle = fopen($file, 'w'))
{
    fwrite($handle, 'sometext');
    fclose($handle);
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>