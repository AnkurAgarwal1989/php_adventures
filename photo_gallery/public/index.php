<?php
require_once ('../includes/initialize.php');

$users = User::find_all();
foreach ($users as $user) {
    echo "Username: " . $user->username . "<br />";
}

?>