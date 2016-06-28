$(document).ready(function(){
	function error_output(error_text, error_element){
		$(error_element).html('ERROR:' + error_text);
		$(error_element).show();
	}

	$('#register').click(function(){
		$.post("/backend/processing/registration", $('#signup').serialize(), function(data){
			if(data == "Success!"){
				// Further processing
				window.location = '/home';
			} else if(data == "Username is missing"){
				error_output('Please enter a username!', '.error1');
			} else if(data == 'Email is empty.'){
				error_output('Please enter an email!', '.error1');
			} else if(data == "Password is empty."){
				error_output('Please enter a password!', '.error1');
			} else if(data == "Username has been taken."){
				error_output('Username has been taken already! <a href="/recovery?email="' + $("#email").val() + '" style="color: blue;">Lost your password?</a>', '.error1');
			} else if(data == "This email has been registered already!"){
				error_output('This email has been taken already. <a href="/recovery?email=' + $('#email').val() + '">Lost your password?</a>', '.error1');
			} else if(data == "Passwords don't match"){
				error_output('Passwords don\'t match!', '.error1');
			} else if(data == "Invalid email"){
				error_output('Invalid email!', '.error1');
			} else if(data == "invalid captcha."){
				error_output('Please complete the captcha!', '.error1');
			} else if(data == "Invalid username."){
				error_output('Invalid username.', '.error1');
			} else {
				console.log(data);
			}
		});
	});

	$('#sLogin').click(function(){
		$.post("/backend/processing/login", $('#login').serialize(), function(data){
			if(data == "Valid combination."){
				// Further processing
				window.location = "/home";
			} else if(data == "Username exists, password incorrect."){
				error_output('Password is incorrect. Please try again.', '#error');
			} else if(data == 'Username doesn\'t exist.'){
				error_output('Username doesn\'t exist!', '#error');
			} else if(data == "Unknown exception occured."){
				error_output('Unknown exception occured. Please try again later!', '#error');
			} else {
				console.log('An error occured that is beyond our control:\n' + data);
			}
		});
	});

	$('#sRegister').click(function(){
		$('.login').hide();
		$('#register_object').show();
	});

	$('.chat-input').focusout(function(){
		if($('.chat-input').val() === ""){
			$('.chat-input').val("Type your message here!");
		}
	});

	$('.chat-input').click(function(){
		if($('.chat-input').val() == "Type your message here!"){
			$('.chat-input').val("");
		}
	});

	$('.button_button').click(function(){
		var id = $(this).attr("id");
		if(id == "Button_Home"){
			window.location = '/home';
		} else if(id == "Button_Me"){
			window.location = '/me';
		} else if(id == "Button_Shop"){
			window.location = '/shop';
		} else if(id == "Button_Forums"){
			window.location = '/forums';
		} else if(id == "Button_Blog"){
			var win = window.open('http://blog.tropicworlds.com/', '_blank');
  			win.focus();
		}
	});
});