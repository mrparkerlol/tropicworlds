<?php
    include 'essentials.php';
    
    // Look ma, no hands!
    if($_SERVER['REMOTE_ADDR'] == "159.203.32.148"){ // We should really switch to local-communication, but this will do
        // Really the only values we need to set
        $user = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['username'])));
        $email = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['email'])));
        $password = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['password'])));
        
        // Making shit safe
        try {
            mysqli_query($db, "INSERT INTO `users` (`username`,`email`,`password`,`rank`,`profile_picture`,`currency_1`,`currecny_2`,`pm_count`,`forum_count`,`is_banned`) VALUES ('" . $user . "','" . $email . "','" . $password . "','User','http://cdn.tropicworlds.com/images/avatars/Default-1.jpg',10,0,0,0,0)");
            
            // Log the user in
            $sess = crypt($_POST['username'] . rand(5, 100000), $crypt);
			mysqli_query($db, "UPDATE `users` SET `session_data` = '" . $sess . "' WHERE `username` = '" . $user . "'");           
            
            // Return session
            echo $sess;
        } catch(Exception $e){
            echo 'ERROR: Query has failed!';
        }
    } else {
        echo '403';
    }
?>