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

<html>
    <head>
        <title>Photo Gallery Admin</title>
        <link href="../stylesheets/main.css" media="all" rel="stylesheet"
              type="text/css" />
    </head>
    
    <body>
        <div id ="header">
            <h1>Photo Gallery Admin</h1>
        </div>
        
        <div id ="main">
            <h2>Menu</h2>
        </div>
        
        <div id ="footer">
            Copyright <?php echo date('Y', time()); ?>, Ankur
        </div>
    </body>
</html>
