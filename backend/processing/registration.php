<?php
session_start();

require 'processing_essentials.php';
mysqli_select_db($db, 'users');

// Registration V0.0.1
if(isset($_POST['submit'])){ // Did the user submit the form?
    // Set our registration values
    $user = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['username']))); // Username
    $email = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['email']))); // Email
    $pass = crypt($_POST['password'], $crypt); // Password (KEEP THIS HASH SECRET OR PASSWORDS WILL GET CRACKED!)
    $pass2 = crypt($_POST['password2'], $crypt); // Password Confirmation (KEEP THIS HASH SECRET OR PASSWORDS WILL GET CRACKED!)
    $recaptcha = $_POST['g-recaptcha-response'];
    $default_character = "http://cdn.tropicworlds.com/images/avatars/Default-1.jpg";

	if(preg_match('/\s/', $user) or preg_match('/\s/', $pass)){
		if(preg_match('/\s/', $user)){
			echo 'Invalid username.';
		} elseif(preg_match('/\s/', $pass)) {
			echo 'Invalid password. Only a-z, 0-9, and special characters allowed.';
		}
	} else {
		if(preg_replace('/[^\da-z]/i', '', $user) == $user){
			if(strlen($user) >= 20){
				echo 'Username too long.';
			} else {
				if(filter_word($user, $badwords)){
					$result = mysqli_query($db, 'SELECT * FROM `users` WHERE `username` = "' . $user . '"') or die(mysqli_error($db)); // Check if the username exists
					$result2 = mysqli_query($db, 'SELECT * FROM `users` WHERE `email` = "' . $email . '"') or die(mysqli_error($db)); // Check to see if the email is already used
						
					$recaptcha = $_POST['g-recaptcha-response'];

					if(!empty($recaptcha)){
						$secret = '6LdnPxITAAAAAF1_HITiFse0dGPXspO8nxiKPUnv';
						$ip = $_SERVER['REMOTE_ADDR'];
						$url = 'https://www.google.com/recaptcha/api/siteverify' . '?secret=' . $secret . '&response=' . $recaptcha . '&remoteip=' . $ip;

						$res = getCurlData($url);
						$res = json_decode($res, true);

						//reCaptcha success check 
						if($res['success']){
							if(empty($user) or empty($email) or empty($pass)){
								if(empty($user)){
									echo 'Username is missing';
								} elseif(empty($email)){
									echo 'Email is empty.';
								} elseif(empty($pass)){
									echo 'Password is empty.';
								} else {
									echo 'Unknown exception occured.';
								}
							} else { // Phase 1 pass
								if(mysqli_num_rows($result) == 1 or mysqli_num_rows($result2) >= 1){ // Username/email is already taken
									if(mysqli_num_rows($result) == 1){
										echo 'Username has been taken.';
									} else {
										echo 'This email has been registered already!';
									}
								} elseif($pass !== $pass2) { 
									echo 'Passwords don\'t match';
								} elseif(strpos($email, "@") == false) {
									echo 'Invalid email';
								} else {
									// Process information
                                    try { // Let's make sure this is safe. We don't want errors exposing anything, right?
                                        $curl = curl_init(); // Init the cURL
                                        curl_setopt($curl, CURLOPT_URL,"http://api.tropicworlds.com/registration.php"); // Set the POST url
                                        curl_setopt($curl, CURLOPT_POST, 1); // wtf does this do lel
                                        curl_setopt($curl, CURLOPT_POSTFIELDS,"username=$user&email=$email&password=$pass&currency_1=10&currency_2=0&pm_count=0&forum_count=0&is_banned=0&rank='User'"); // OH BABY A PENTA+!
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Accepting return values, right?
                                        $result = curl_exec($curl); // Time to put the cat in the mailbox
                                        
                                        if((string)$result){ // OOH!!! UR MUM RETURNED SOMETHING!!!!!!!?!?!??!?!
                                            if((string)$result != "ERROR: Query has failed!"){
                                                $_SESSION['logged_in'] = (string)$result; // Lel we all know this aint gonna work?
                                                
                                                echo 'Success!'; // But we will say success anyways?!?!
                                            } else {
                                                echo 'Failed to register user.';
                                            }
                                        } else { // BOOOOO!!!!!!!! *cries*
                                            echo 'Failed to register user.';
                                        } // Smexy end statement. Sexy curves! Just like my women.
                                        
                                        curl_close ($ch); // Oh great, you put on the Steven Chilton character on again!
                                    } catch(Exception $e){
                                        echo 'something wrong!'; // ADAM AND STEVE, NOT ADAM AND EVE!
                                    }
								}
							}
						} else {
							echo 'invalid captcha.';
						}
					} else {
						echo 'invalid captcha.';
					}
				} else {
					echo 'Invalid username.';
				}
			}
		} else {
			echo 'Invalid username.';
		}
	}
} else {
	echo 'Invalid request.';
} // He's dead, Jim!
?>