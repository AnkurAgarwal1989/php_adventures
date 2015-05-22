<?php
/* 
 * Index page for admin folder
 */
require_once ('../../includes/initialize.php');

//If person is not logged in..redirect to login page
if(!($session->is_logged_in())){
    redirect_to('login.php');
}
?>

<?php include_layout_template('admin_header.php') ?>

<?php 

?>

<?php 
//Creating new user
$new_user = new User();
$new_user->first_name = "Dead";
$new_user->last_name = "Pool";
$new_user->password = "guns";
$new_user->username = "assassin";
if ($new_user->create())
{
    $id = $new_user->id;
    echo "User Created: " . $new_user->id .PHP_EOL;
}

//Updating
$user = User::find_by_id(4);
/*$user->first_name = "Dead";
$user->last_name = "Pool";
$user->password = "blades";
$user->username = "killers";*/
if ($user->delete())
    echo "deleted";
?>
        
<?php include_layout_template('admin_footer.php') ?>
