<?php
	// Profiles
	require 'backend/processing/processing_essentials.php';

	if(isset($_GET['id'])){
		$id = mysqli_real_escape_string($db, htmlentities(stripslashes($_GET['id'])));
	} elseif(isset($_GET['username'])) {
		$id = mysqli_real_escape_string($db, htmlentities(stripslashes($_GET['username'])));
	} else {
		echo 'Invalid request given.';
	}
?>