<?php

echo decoct(fileperms('file_permissions.php'));
chmod('file_permissions.php', 0777);
echo "<br />";
echo decoct(fileperms('file_permissions.php'));
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo is_readable('file_permissions.php')? "yes" : "no";
echo is_writable('file_permissions.php')? "yes" : "no";
?>