<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php
	if (!$curr_page){
	redirect_to("manage_content.php");
	}

	$id = $curr_page["id"];

	$query  = "DELETE FROM pages WHERE ";
	$query .= "id = {$id} ";
	$query .= "LIMIT 1";
	
	$result = mysqli_query($connection, $query);
	if ($result && mysqli_affected_rows($connection) == 1){
		$_SESSION["message"] = "Page deleted successfully.";
		redirect_to("manage_content.php");
	}else {
		$_SESSION["message"] = "Page deletion failed.";
		redirect_to("manage_content.php?page={$id}");
	}
?>