<?php
	session_start();
	require 'processing_essentials.php';

	mysqli_select_db($db, 'users');

	if(isset($_POST['submit'])){
		if(!empty($_POST['message']) && !empty($_POST['message']) && strlen(preg_replace('/\s+/u','', $_POST['message'])) !== 0){
			$username = mysqli_real_escape_string($db, htmlentities(stripslashes($_SESSION['logged_in'])));
			$result = mysqli_query($db, "SELECT * FROM users WHERE username = '" . $username . "'");
			$result_1 = mysqli_fetch_assoc($result);
			$index = $result_1['rank'];

			if($index !== "User" && $index !== "VIP" && $index !== "Moderator" && $index !== "Community Manager" && !empty($index) && !empty($_SESSION['logged_in'])){
				$message = mysqli_real_escape_string($db, $_POST['message']);
			} else if(preg_match("/[^A-Z]/", $_POST['message']) or preg_match("/[^a-z]/", $_POST['message']) or preg_match("/[^0-9]/", $_POST['message'])){
				$message = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['message'])));
			} else {
				// Invalid message won't be sent
				echo 'Invalid request.';
			}

			mysqli_select_db($db, 'chat');

			if(filter_word($message, $badwords)){
				mysqli_query($db, "INSERT INTO `messages` (`username`, `message`) VALUES ('" . $username . "', '" . $message . "')");
				echo 'successfully inserted message!';
			} else {
				echo 'Message blocked.';
			}
		} else {
			echo 'Invalid request.';
		}
	} else {
		mysqli_select_db($db, 'chat');

		$result = mysqli_query($db, "SELECT * FROM `messages` ORDER BY `id` DESC LIMIT 25");

		mysqli_select_db($db, 'users');

		while($row = mysqli_fetch_assoc($result)){
			$result2 = mysqli_query($db, "SELECT * FROM `users` WHERE `username` = '" . $row['username'] . "'");
			$resut2_result = mysqli_fetch_array($result2);
			if($resut2_result['rank'] == "Community Manager") { $r = "Community_Manager"; } else { $r = resut2_result['rank']; }
			echo '<table id="center_ele"><tr><td id="profile_picture"><img src="' . $resut2_result['profile_picture'] . '" alt="' . $row['username'] . '" style="position:relative; top:-8px; left:12px; top:auto; width:50px; height:73px;" /></td><td id="message_background"><p id="username">' . $row['username'] . ' (<b style="color:green;" id="' . $r . '">' . $resut2_result['rank'] . '</b>)</p><p style="position:relative; top:-25px;" id="ID:' . $row['id'] . '" class="message">' . $row['message'] . '</p></td><td><i class="fa fa-exclamation-circle tiny report" id="ID:' . $row['id'] . '"></i></td></tr></table>';
		}
	}
?>