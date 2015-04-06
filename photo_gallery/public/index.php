<?php
require_once("../includes/database.php");
require_once("../includes/functions.php");
require_once("../includes/user.php");

$users = User::find_all();
foreach ($users as $user) {
    echo "Username: " . $user->username . "<br />";
}

?>