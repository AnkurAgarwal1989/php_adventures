<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php
	if (!$curr_subject){
	redirect_to("manage_content.php");
	}

	$id = $curr_subject["id"];

	$pages_for_subject = find_pages_for_subject($id, false);
	if(mysqli_num_rows($pages_for_subject) > 0){
		$_SESSION["message"] = "Page could not be deleted. Please delete child pages first.";
		redirect_to("manage_content.php?subject={$id}");
	}

	
	$query  = "DELETE FROM subjects WHERE ";
	$query .= "id = {$id} ";
	$query .= "LIMIT 1";
	
	$result = mysqli_query($connection, $query);
	if ($result && mysqli_affected_rows($connection) == 1){
		$_SESSION["message"] = "Subject deleted successfully.";
		redirect_to("manage_content.php");
	}else {
		$_SESSION["message"] = "Subject deletion failed.";
		redirect_to("manage_content.php?subject={$id}");
	}
?>