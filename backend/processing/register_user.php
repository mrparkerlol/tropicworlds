<?php
require 'processing_essentials.php';

if(isset($_POST['submit'])){
	echo 'submitted';
} else {
	echo 'error: form not submitted.';
}

?>