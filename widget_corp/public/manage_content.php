<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>
<div id = "main"> 
	<div id = "navigation">
		<?php echo navigation($curr_subject, $curr_page); ?>
		<br />
		<a href="new_subject.php">+ Add a subject</a>
	</div>
	<div id = "page">
		<?php echo message(); ?>
		<?php if ($curr_subject) { ?>
			<h2> Manage Subject </h2>
			Menu Name: <?php echo htmlentities($curr_subject["menu_name"]); ?> <br />
			Position: <?php echo $curr_subject["position"]; ?> <br />
			Visible: <?php echo $curr_subject["visible"] == 1 ? 'Yes': 'No'; ?> <br />
			<br />
			<a href="edit_subject.php?subject=<?php echo urlencode($curr_subject["id"]); ?>">Edit Subject</a>

			<h4> 
				<a href="new_page.php?subject=<?php echo urlencode($curr_subject["id"]); ?>">+ Add Page to this subject</a> 
			</h4>
		<?php } elseif ($curr_page) { ?>
			<h2> Manage Page </h2>
			Menu Name: <?php echo htmlentities($curr_page["menu_name"]); ?><br />
			Position: <?php echo $curr_page["position"]; ?> <br />
			Visible: <?php echo $curr_page["visible"] == 1 ? 'Yes': 'No'; ?> <br />
			Content: <br />
			<div class = "view-content">
				<?php echo htmlentities($curr_page["content"])?>
			</div>
			<br />
			<a href="edit_page.php?page=<?php echo urlencode($curr_page["id"]); ?>">Edit Page</a>
		<?php } else { ?>
			Please select a subject or page.
		<?php } ?>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>