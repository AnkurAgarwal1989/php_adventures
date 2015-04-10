<?php 
include_once('../includes/initialize.php');
?>

<?php 
include_layout_template('header.php');
?>

<?php
$users = User::find_all();

foreach ($users as $user) {
    echo "Username: " . $user->username . "<br />";
}

?>

<?php 
include_layout_template('footer.php');
?>