<?php
	session_start();
	require 'backend/processing/processing_essentials.php';

	$sess = htmlentities(stripslashes($_SESSION['logged_in'])); //sanitize the login variable cuz they think we're stupid and arrogant
    
    $sess_id = postCurlData("http://api.tropicworlds.com/get_session.php", "username=" . $sess . "&s9ddfs8fs89df89ds8f89a809sf089ds8f0sd8f8dsf09ds98f"); // Get the session data
    
	if(isset($_SESSION['logged_in']) && !empty($sess_id)){
	   $profile_picture = postCurlData("http://api.tropicworlds.com/get_profile_picture.php", "username=" . $sess); // Get the profile picture
    } else {
		if(isset($_SESSION['logged_in'])){ // If logged_in is the only thing defined
			session_destroy();
			header('Location: /login');
		} else { // Nothing is obviously set
			header('Location: /login');
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home - TropicWorlds.com</title>

		<link href="/assets/css/global.css" rel="stylesheet" />
		<link href="/assets/css/chat.min.css" rel="stylesheet" />
		<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />

		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/main.min.js"></script>

		<script>
			$(document).ready(function(){
				//$('.chat_messages').load('/backend/processing/chat');
			});
		</script>
	</head>
	<body>
		<?php
			require 'includes/nav.php';
		?>

		<div class="announcement_display" style="font-family:myFirstFont; background-color:lightblue; color:white; height:25px; position:absolute; left:0; right:0; top:35px; margin-left:auto; margin-right:auto; text-align:center;">
			<b>DB wipe is coming right before beta! So please contact us by sending your current username to admin[@]mrparker.pw so that we can give you the alpha badge!</b>
		</div>

		<div class="profile_area">
			<img src=<?php echo '"' . $profile_picture . '"'; ?> style="width:125px; height:185px;" />
		</div>

		<div class="chat_area">
			<form action="" method="post" id="chat_form">
				<textarea name="message" maxlength="140" class="chat-input" style="width: 585px; height: 146px; resize: none; border:solid; border-width:2px; border-color:lightgrey lightgrey; border-radius:5px;">Type your message here!</textarea>
				<input type="hidden" name="submit" value="Submitted!" />
			</form>
		</div>

		<div class="chat_messages"></div>

		<script src="/assets/js/socket.io.js"></script>
	    <script src="/assets/js/jquery.js"></script>
	    <script>
	    	var pop=new Audio("/assets/sounds/pop.mp3"),socket=io.connect("//server.tropicworlds.com:8443"),len=0;$(".chat-input").keypress(function(e){return 13==e.which?(socket.emit("chatty-room-1",$(".chat-input").val(),<?php echo '"' . $sess_id . '"'; ?>),$(".chat-input").is(":focus")?$(".chat-input").val(""):$(".chat-input").val("Type a message here!"),!1):void 0}),socket.on("chatty-room-1",function(e){setTimeout(1e3),$(e).prependTo($(".chat_messages")).hide().fadeIn(250,function(){len=$(".chat_messages").children().length,len>=16&&(console.log("Time to remove some messages! We gotta move that gear up!"),$(".chat_messages table:last-child").remove())}),pop.play()});
	    </script>
	</body>
</html>