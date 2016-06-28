<?php
	session_start();

	if(isset($_SESSION['logged_in'])){
		header('Location: /home');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TropicWorlds - Free Online Social Hangout</title>
		<link rel="stylesheet" href="/assets/css/style3.min.css" />
		<link rel="stylesheet" href="/assets/css/do_not_minify.css" />
		<link rel="stylesheet" href="/assets/css/global.css" />
		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/main.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script>$(document).ready(function(){$('#register_object').hide();});</script>
	</head>
	<body>
		<img src="/assets/images/logo_large.svg" id="logo_top" />
		
		<div class="login">
			<b id="error"></b>
			<form action="" method="post" id="login">
				<div id="inputs">
					<input type="text" name="username" id="username" class="input" placeholder="Username" />
					<br>
					<input type="password" name="password" id="password" class="input" placeholder="Password" />
					<br>
					<button name="submit" value="Login" class="button" id="sLogin" onClick="javascript:return false;">Login</button>
					<br>
					<input type="hidden" name="submit" value="Submitted!" />
					<button name="submit" value="Register" class="button" id="sRegister" onClick="javascript:return false;">Register</button>
				</div>
			</form>
		</div>

		<div id="register_object">
			<b class="error1"></b>
			<form action="" method="POST" id="signup">
				<input type="text" name="username" id="username" class="input" placeholder="Username" />
				<br>
				<input type="text" name="email" id="email" class="input" placeholder="Email" />
				<br>
				<input type="password" name="password" id="pass" class="input" placeholder="Password" />
				<br>
				<input type="password" name="password2" id="pass2" class="input" placeholder="Confirm Password"/>
				<br>
				<input type="hidden" name="submit" value="Submitted!" />
				<div class="g-recaptcha" id="register-recaptcha" data-sitekey="6LdnPxITAAAAAFnrsDq2TZZpMgRZ4hJS5ZyMJld7"></div>
				<br>
				<button name="submit" value="Register" class="button" id="register" onClick="javascript:return false;">Register</button>
			</form>
			<div class="hr_alertnative"></div>
			<b id="make_frs_text">Make friends, have fun!</b>
			<img src="/assets/images/3char.png" id="characters" />
		</div>
	</body>
</html>