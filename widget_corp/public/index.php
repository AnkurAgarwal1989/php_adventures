<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(true); ?>
<div id = "main"> 
	<div id = "navigation">
		<?php echo public_navigation($curr_subject, $curr_page); ?>
	</div>
	<div id = "page">
		<?php if ($curr_page) { ?>
			<h2> <?php echo htmlentities($curr_page["menu_name"])?></h2>
			<div class = "view-content">
				<?php echo nl2br(htmlentities($curr_page["content"]))?>
			</div>
		<?php } else { ?>
			<p>
				Welcome!
			</p>
		<?php } ?>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>