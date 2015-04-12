<?php
/* 
 * See all the logs in the log file
 */
require_once ('../../includes/initialize.php');

//If person is not logged in..redirect to login page
if(!($session->is_logged_in())){
    redirect_to('login.php');
}
$logfilename = SITE_ROOT.DS."logs".DS."log.txt";
?>
<?php 
/* @var $_GET type */
if (filter_input(INPUT_GET, 'clear') === 'true'){
    $handle = fopen($logfilename, "w"); //Opening an existing file in "w" clears it
    fclose($handle);
    log_action("Log Cleared", "by User ID {$session->user_id}");
    //This so that the browser doesn't show "clear=true"
    redirect_to("logcheck.php");   
}
?>

<?php include_layout_template("admin_header.php") ?>
<p><a href="index.php"> Back </a></p></br>

<h2>Logs</h2>
<p><a href="logcheck.php?clear=true"> Clear Log </a></p>
<?php
if (file_exists($logfilename)){
    if (file_exists($logfilename) && is_readable ($logfilename)) {
        echo "<ul class = \"log-entries\">";
        $file_handle = fopen($logfilename, "r");
        while (!feof($file_handle)) {
           $line = fgets($file_handle);
           //Last entry in while would be ""..we don't wanna show an empty list item
           echo trim($line) != "" ? "<li>{$line}</li>" : "";
        }
        echo "</ul>";
        fclose($file_handle);
    }
}
else{
    "Log file does not exist";
}
?>
        

<?php include_layout_template('admin_footer.php') ?>