<?php
/* 
 * Index page for admin folder
 */

require_once('../../includes/functions.php');
require_once('../../includes/session.php');
require_once('../../includes/database.php');

if($session->is_logged_in()){
    redirect_to('login.php');
}


?>
