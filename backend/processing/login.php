<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

session_start();
require 'processing_essentials.php';

if(isset($_POST['submit'])){
	$user = htmlentities(stripslashes($_POST['username']));
	$pass = crypt($_POST['password'], $crypt);
    
    $result = postCurlData("http://api.tropicworlds.com/login.php","username=" . $user . "&password=" . $pass . "&sd88s9d89-9sfsd0f09sd80f9d80sf8ds800f809809ds");
    
    $safe_string = (string)$result;
    
    if($safe_string){ // OOH!!! UR MUM RETURNED SOMETHING!!!!!!!?!?!??!?!
        if($safe_string != "ERROR: Query has failed!"){
            if($safe_string == "invalid username") {
                echo 'Username doesn\'t exist.';
            } elseif($safe_string == "invalid password"){
                echo 'Username exists, password incorrect.';
            } else {
                $_SESSION['logged_in'] = $user; // Lel we all know this aint gonna work?
                
                echo 'Valid combination.';
            }
        } else {
            echo 'Unknown exception occured.';
        }
    } else { // BOOOOO!!!!!!!! *cries*
        echo 'Unknown exception occured.';
    } // Smexy end statement. Sexy curves! Just like my women.
}
?>