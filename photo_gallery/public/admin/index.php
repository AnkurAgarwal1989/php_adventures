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

            <h2>Menu</h2>
        
<?php include_layout_template('admin_footer.php') ?>
