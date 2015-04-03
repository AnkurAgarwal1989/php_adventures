<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php find_selected_page(); ?>
<?php
	if (!$curr_page){
	redirect_to("manage_content.php");
	}
?>
<?php
	if (isset($_POST["submit"])) {
		//Process form
		//Escape strings to prevent any SQL injections...fucntion in functions.php file
		//validations
		$required_fields = array("menu_name", "position", "visible", "content");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if (empty($errors)){

			$id = $curr_page["id"];
			$menu_name = mysql_prep($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];
			$content = mysql_prep($_POST["content"]);

			$query  = "UPDATE pages SET ";
			$query .= "menu_name = '{$menu_name}', ";
			$query .= "position = {$position}, ";
			$query .= "visible = {$visible}, ";
			$query .= "content = '{$content}' ";
			$query .= "where id = {$id} ";
			$query .= "LIMIT 1";
			
			$result = mysqli_query($connection, $query);
			//if it fails...we wil get -1
			if ($result && mysqli_affected_rows($connection) >= 0){
				$_SESSION["message"] = "Page edited successfully.";
				redirect_to("manage_content.php");
			}else {
				$_SESSION["message"] = "Page edit failed.";
			}
		}

	}
?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>


<div id = "main"> 
	<div id = "navigation">
		<?php echo navigation($curr_subject, $curr_page); ?>
	</div>
	<div id = "page">
		<?php echo message(); ?>
		<?php 
			echo form_errors($errors);
		?>
		<h2>Edit Page: <?php echo htmlentities($curr_page["menu_name"]); ?> </h2>
		<form action="edit_page.php?page=<?php echo urlencode($curr_page["id"]); ?>" method="post">
			<p>Menu name:
				<input type="text" name="menu_name" value="<?php echo htmlentities($curr_page["menu_name"]); ?>"/>
			</p>
			<p>Position:
				<select name="position">
					<?php
						$page_set = find_pages_for_subject($curr_page["subject_id"], false);
						$page_count = mysqli_num_rows($page_set);
						echo "<option value = \"{$curr_page["position"]}\">{$curr_page["position"]}</option>";
						for($count = 1; $count <= $page_count; $count++){
							echo "<option value = \"{$count}\">";
							if ($curr_page["position"] == $count){
								echo "Current: ";
							}
							echo "{$count}</option>";
						}
					?>
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" <?php if ($curr_page["visible"] == 0) {echo "checked";} ?> /> No
				&nbsp;
				<input type="radio" name="visible" value="1" <?php if ($curr_page["visible"] == 1) {echo "checked";} ?> /> Yes
			</p>
			<p>
				<textarea name = "content" rows = "20" cols = "80"><?php echo htmlentities($curr_page["content"]); ?> </textarea>
			</p>

			<input type="submit" name= "submit" value="Edit Page" />
		</form>
		<br />
		<a href="manage_content.php?page=<?php echo urlencode($curr_page["id"]); ?>">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_page.php?page=<?php echo urlencode($curr_page["id"]); ?>" onClick = "return confirm('Are you sure?');">Delete Page</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>