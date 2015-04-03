<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php find_selected_page(); ?>
<?php
	if (!$curr_subject){
	redirect_to("manage_content.php");
	}
?>
<?php
	if (isset($_POST["submit"])) {
		//Process form
		//Escape strings to prevent any SQL injections...fucntion in functions.php file
		//validations
		$required_fields = array("menu_name", "position", "visible");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if (empty($errors)){

			$id = $curr_subject["id"];
			$menu_name = mysql_prep($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];

			$query  = "UPDATE subjects SET ";
			$query .= "menu_name = '{$menu_name}', ";
			$query .= "position = {$position}, ";
			$query .= "visible = {$visible} ";
			$query .= "where id = {$id} ";
			$query .= "LIMIT 1";
			
			$result = mysqli_query($connection, $query);
			//if it fails...we wil get -1
			if ($result && mysqli_affected_rows($connection) >= 0){
				$_SESSION["message"] = "Subject edited successfully.";
				redirect_to("manage_content.php");
			}else {
				$_SESSION["message"] = "Subject edit failed.";
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
		<h2>Edit Subject: <?php echo htmlentities($curr_subject["menu_name"]); ?> </h2>
		<form action="edit_subject.php?subject=<?php echo urlencode($curr_subject["id"]); ?>" method="post">
			<p>Menu name:
				<input type="text" name="menu_name" value="<?php echo htmlentities($curr_subject["menu_name"]); ?>"/>
			</p>
			<p>Position:
				<select name="position">
					<?php
						$subject_set = find_all_subjects(false);
						$subject_count = mysqli_num_rows($subject_set);
						echo "<option value = \"{$curr_subject["position"]}\">{$curr_subject["position"]}</option>";
						for($count = 1; $count <= $subject_count; $count++){
							echo "<option value = \"{$count}\">";
							if ($curr_subject["position"] == $count){
								echo "Current: ";
							}
							echo "{$count}</option>";
						}
					?>
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" <?php if ($curr_subject["visible"] == 0) {echo "checked";} ?> /> No
				&nbsp;
			<input type="radio" name="visible" value="1" <?php if ($curr_subject["visible"] == 1) {echo "checked";} ?> /> Yes
			</p>
<input type="submit" name= "submit" value="Edit Subject" />
		</form>
		<br />
		<a href="manage_content.php?subject=<?php echo urlencode($curr_subject["id"]); ?>">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_subject.php?subject=<?php echo urlencode($curr_subject["id"]); ?>" onClick = "return confirm('Are you sure?');">Delete Subject</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>