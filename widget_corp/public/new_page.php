<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php find_selected_page(); ?>
<?php
	// Need a subject parent to be able to create a page
	if (!$curr_subject){
	redirect_to("manage_content.php");
	}
?>
<?php
	if (isset($_POST["submit"])){
			//Process form
			//Escape strings to prevent any SQL injections...fucntion in functions.php file
			$menu_name = mysql_prep($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];
			$content = mysql_prep($_POST["content"]);
			$subject_id = $curr_subject["id"];

			//validations
			$required_fields = array("menu_name", "position", "visible", "content");
			validate_presences($required_fields);

			$fields_with_max_lengths = array("menu_name" => 30);
			validate_max_lengths($fields_with_max_lengths);

			if (!empty($errors)){
				$_SESSION["errors"] = $errors;
				redirect_to("new_page.php?subject=". urlencode($curr_subject["id"]));
			}
			
			$query  = "INSERT INTO pages (";
			$query .= " subject_id, menu_name, position, visible, content ";
			$query .= ") VALUES (";
			$query .= " {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}' ";
			$query .= ")";
			
			$result = mysqli_query($connection, $query);

			if ($result){
				$_SESSION['message'] = "Page created successfully.";
				redirect_to("manage_content.php?subject=". urlencode($curr_subject["id"]));
			}else {
				$_SESSION['message'] = "Page creation failed.";
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
			$errors = errors();
			echo form_errors($errors);
		?>
		<h2>Create Page</h2>
		<form action="new_page.php?subject=<?php echo urlencode($curr_subject["id"]); ?>" method="post">
			<p>Menu name:
				<input type="text" name="menu_name" value=""/>
			</p>
			<p>Position:
				<select name="position">
					<?php
						$page_set = find_pages_for_subject($curr_subject["id"], false);
						$page_count = mysqli_num_rows($page_set);
							
						for($count = 1; $count <= $page_count + 1; $count++){
							echo "<option value = \"{$count}\">{$count}</option>";
						}
					?>
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" /> No
				&nbsp;
			<input type="radio" name="visible" value="1" checked/> Yes
			</p>
			<p>Content: </br>
				<textarea name = "content" rows = "20" cols = "80"></textarea>
			</p>
			<input type="submit" name= "submit" value="Create Page" />
		</form>
		<br />
		<a href="manage_content.php?subject=<?php echo urlencode($curr_subject["id"]) ?>">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>