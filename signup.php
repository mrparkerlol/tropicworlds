<html>
	<head>
		<title>Early Registration - TropicWorld.net</title>
		<link rel="stylesheet" href="/assets/css/style.min.css">
		<link rel="stylesheet" href="/assets/css/global.css" />
		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/main.js"></script>
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body onContextMenu="javascript:return false;">
		<img src="/assets/images/logo_large_SVG.svg" id="logo_top" />

		<div id="register_object">
			<img src="/assets/images/bubble_alert.jpg" id="error1" /><b class="error1"></b>
			
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