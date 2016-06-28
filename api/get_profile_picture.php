<?php
    require 'essentials.php';
    if(isset($_POST['username'])){
        $user = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['username'])));
        
        $query = mysqli_query($db, "SELECT `profile_picture` FROM users.users WHERE `username` = '" . $user . "'") or die(mysqli_error($db));
        $result = mysqli_fetch_array($query);
        
        echo $result['profile_picture'];
    }
?>