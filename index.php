<?php
	session_start();
	
	if(isset($_SESSION['logged_in'])){
		//header('Location: /home');
		header('Location: /home');
	} else {
		header('Location: /login');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TropicWorlds - Coming Soon!</title>
		<link rel="stylesheet" type="text/css" href="/assets/css/style-home.min.css">
	    <link rel="icon" href="/assets/images/favicon2.ico?v=2" type="image/x-icon" />

   		<meta name="author" content="TropicWorlds.com Team" />
    	<meta name="description" content="A creative outlet where users can create their own worlds and socialize on forums, a global chat room, and private messages. Users can then spend in-game currency on in-game items to customize their characters." />
    	<meta name="keywords" content="social network, online game, multiplayer, hangout, chat, mmo, rpg" />

    	<meta name="google-site-verification" content="10y0UW4FFaj464lgrB3QSt33KNOKkCKFFlPRlanLxvQ" />

	    <script>
	    	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-71593978-1', 'auto');ga('send', 'pageview');
		</script>
    </head>
	<body>
		<div id="home_before">
			<img src="/assets/images/logo_large.svg" id="logo_home" alt="TropicWorld's Logo"/>

			<p id="font1">Merry Christmas!</p>
			<p id="font2">We're getting ready for beta.</p>

			<iframe width="560" height="315" src="https://www.youtube.com/embed/tK3xmp0pwJE?rel=0&amp;controls=0&amp;showinfo=0&mp;modestbranding=1&autoplay=true" id="video_home" frameborder="0"></iframe>
		</div>
 	</body>
</html>