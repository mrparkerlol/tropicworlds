<?php
    require 'essentials.php';
    
    if(isset($_POST['9as0d9sdsa9dw8qe8wq80re09q3euljkerfdsjjasd9as8sd89'])){
        $username = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['username'])));
        
        $r = mysqli_query($db, "SELECT `session_data` FROM users.users WHERE `username` = '" . $user . "'");
        $r_r = mysqli_fetch_array($r);
        
        echo $r_r['session_data'];
    }
?>