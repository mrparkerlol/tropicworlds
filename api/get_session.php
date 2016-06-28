<?php
    require 'essentials.php';
    
    if(isset($_POST['s9ddfs8fs89df89ds8f89a809sf089ds8f0sd8f8dsf09ds98f'])) {
        $request = mysqli_real_escape_string($db, htmlentities(stripslashes($_POST['username'])));
    
        $sess_id = mysqli_query($db, "SELECT `session_data` FROM users.users WHERE `username` = '" . $request . "'");
        $result = mysqli_fetch_array($sess_id);
        
        echo $result['session_data'];
    }
?>