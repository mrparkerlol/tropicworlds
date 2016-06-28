<?php 
    include 'essentials.php';
    
    // Look ma, no hands!
    if(isset($_POST['sd88s9d89-9sfsd0f09sd80f9d80sf8ds800f809809ds'])){ // We should really switch to local-communication, but this will do
        // Really the only values we need to set
        $user = mysqli_real_escape_string($db, htmlentities($_POST['username']));
        $password = $_POST['password'];

        // Making shit safe
        try {
            $result_user = mysqli_query($db, "SELECT `username` FROM users.users WHERE `username` = '" . $user . "'");
            $result_pass = mysqli_query($db, "SELECT `password` FROM users.users WHERE `password` = '" . $password . "' AND `username` = '" . $user . "'");
            
            if(mysqli_num_rows($result_user) == 0){
                echo 'invalid username';
            } elseif(mysqli_num_rows($result_pass) == 0 && mysqli_num_rows($result_user) == 1){
                echo 'invalid password';
            } else {
                // Log the user in
                $sess = crypt($_POST['username'] . rand(5, 100000), $crypt);
                mysqli_query($db, "UPDATE `users` SET `session_data` = '" . $sess . "' WHERE `username` = '" . $user . "'");           
                
                // Return session
                echo $sess;
            }
        } catch(Exception $e){
            echo 'ERROR: Query has failed!';
        }
    } else {
        echo '403';
    }
?>