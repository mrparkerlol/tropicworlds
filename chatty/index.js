var app = require('express')();
var http = require('https');
var fs = require('fs');
var sanitizer = require('sanitizer');
var request = require('request');

var https_options = {
    ca: fs.readFileSync("ssl/fullchain.pem"),
  key: fs.readFileSync("ssl/privkey.pem"),
  cert: fs.readFileSync("ssl/cert.pem")
};

var app = http.createServer(https_options);
var io = require('socket.io').listen(app);

var badwords = ['nigg3r','n1gg3r','n1gger','beeyotch','nlgger','shize','c0ck','f7ck','biotch','g@y','shiit','goggle.com','ballsack','&shy','fuck','cunt','s3x','nigger','bitch','nigga','fag','asshole','xhamster','redtube','feg','f4k','clit','bollocks','chesticle','milf','kum','fack','f4ck','masturbate','penis','vagina','dick','pussy','ebony','lesbian','porn','boobs','gay','titties','booty','shit','spunk','cum','horny','cock','homo','cancer','fk','fuk','fuc','arse','axwound','coon','queef','queer','hump','spick','whore','spung','spooge','sperm','rimjob','rectum','titty','handjob','threesome','kunt','foreskin','masturbait','nutsack','jizz','dong','douche','cawk','chode','gangbang','bewb','bestiality','beastiality','abortion','skeet','slut','cuck','masterbiat','wang','rape','testicle','testicular','a55','kush','weed','w33d','dildo','d1ldo','d1ld0','klux','kkk', 'Jesus','allah','ackbar','autistic','autism','drunk','beer','pedo','p0rn','f4ck','meatspin','splerge','4llah','4ckbar','semen','dyke','dike','nazi','jew','adolf','hitler','masturbation','erection','boner','b0ner','b0n3r','hentai','butt plug','clitorus','chink','Joseph Stalin','jerk off','kike','negro','cootie','wank','communist','communism','socialist','capitalist','vajayjay','vag','catholic','minch','nut sack', 'pussies', 'lesbo', 'kraut', 'kyke', 'damn', 'damm', 'prostate', 'viagra', 'cialis', 'p3nis', 'p3n1s', 'condom', 'rapist'];
var word_array = new Array();
var rank_output = '', colour = '',r,str;

function sendPostRequest(arg1,arg2,callback){
    request.post(
        arg1,
        { form: arg2 },
        function (error, response, body) {
            if (!error && response.statusCode == 200) {
                try {
                    callback(body);
                } catch(ex){
                    // Error occured and idk wtf happened god damn it
                }
            }
        }
    );
}

function escapeRegExp(str) {
	return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

function replaceAll(str, find, replace) {
	return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function replaceStuff(string,arg1){
	var str = replaceAll(JSON.stringify(string), '{', '');
	str = str.replace(/\\/g, '');
	str = replaceAll(str, '}', '');
	str = replaceAll(str, '"', '');
	str = replaceAll(str, ':', '');
	if(arg1 == "profile_picture"){str = replaceAll(str, 'http', 'http:');}
	str = replaceAll(str, '[', '');
	str = replaceAll(str, ']', '');
	str = replaceAll(str, arg1, '');

	return str;
}
                    
function process_commands(msg, user_id){
    var query = "SELECT `rank` FROM users.users WHERE `session_data` = ?"; // remove after done with shit
    var response = sendPostRequest();
    var level_of_request = replaceStuff(JSON.stringify(result), 'rank');
    msg = sanitizer.escape(msg);
    if(level_of_request == "Moderator" || level_of_request == "Owner" || level_of_request == "Co-Owner" || level_of_request == "Admin" || level_of_request == "Bob"){
        // Process our commands
        if(msg.indexOf("ban")){
            var m = msg.substring(5);

            con.query("UPDATE users.users SET `is_banned` = 1 WHERE `username` = ?", m, function(err, result){
                if(err){
                    console.log("An error occuredd while trying to ban the user: " + err);
                } else {
                    console.log("User was banned. This action was logged.");
                }
            });
        } else if(msg.indexOf("mute")){
            console.log(msg.substring(6));
        }
    }
}

function send_chat(msg){
	// Output to users after words have been filtered
    if(word_array[0] == "Bob"){
        io.emit('chatty-room-1', '<table id="center_ele" style="table-layout:fixed;"><tr><td id="profile_picture"><img src="' + word_array[2] + '" alt="' + word_array[0] + '" style="position:relative; top:-8px; left:12px; top:auto; width:50px; height:73px;" /></td><td id="message_background"><p id="username">' + word_array[0] + rank_output + '</p><p style="position:relative; top:-25px; width:750px; word-wrap:break-word;" id="ID:' + word_array[3] + '" class="message rainbows">' + msg + '</p></td><td><i class="fa fa-exclamation-circle tiny report" id="ID:' + word_array[3] + '"></i></td></tr></table>');
    } else {
        io.emit('chatty-room-1', '<table id="center_ele" style="table-layout:fixed;"><tr><td id="profile_picture"><img src="' + word_array[2] + '" alt="' + word_array[0] + '" style="position:relative; top:-8px; left:12px; top:auto; width:50px; height:73px;" /></td><td id="message_background"><p id="username">' + word_array[0] + rank_output + '</p><p style="position:relative; top:-25px; width:750px; word-wrap:break-word;" id="ID:' + word_array[3] + '" class="message">' + msg + '</p></td><td><i class="fa fa-exclamation-circle tiny report" id="ID:' + word_array[3] + '"></i></td></tr></table>');        
    }

    query("INSERT INTO chat.messages (`username`,`message`) VALUES('" + word_array[0] + "', ?)", msg);
}

app.listen(8443, function(){
    // output to the console what port this server is running on
    console.log('Listening on *:2083');
});

io.on('connection', function(socket){
    console.log('A user connected!');
	socket.on('chatty-room-1', function(msg, user_id){
		user_id = sanitizer.escape(user_id);

		con.query("SELECT `username` FROM users.users WHERE `session_data` = ?", user_id, function(err, result){
			if(JSON.stringify(result).indexOf("username") == -1){
				console.log("Someone is trying to bypass the system...");
			} else {
				if(msg != ""){
				  	// Filter words (if any exist in the message)
					for (var i = 0; i < badwords.length; i++) {
					    var pat = badwords[i].slice(0, -1).replace(/([a-z])/g, "$1[^a-z]*") + badwords[i].slice(-1);
					    var rxp = new RegExp(pat, "ig");
					    msg = msg.replace(rxp, "[redacted]");
					}
					
					query("SELECT `username` FROM users.users WHERE `session_data` = ?",user_id,function(data){
                        data = replaceStuff(JSON.stringify(data),"username");
                        word_array[0] = data;
                    });
					
                    query("SELECT `rank` FROM users.users WHERE `session_data` = ?",user_id,function(data){
                        data = replaceStuff(JSON.stringify(data),"rank");
                        word_array[1] = data;
                    });
                    
					query("SELECT `profile_picture` FROM users.users WHERE `session_data` = ?",user_id,function(data){
                        data = replaceStuff(JSON.stringify(data),"profile_picture");
                        word_array[2] = data;
                    });

					function getId(callback){
						con.query("SELECT LAST_INSERT_ID() FROM chat.messages LIMIT 1", function(err, result){
							// We really need a one-line solution to this problem...
							str = replaceStuff(JSON.stringify(result),"LAST_INSERT_ID()");

							callback(null,str);
						});
					}
					
					getId(function(err,data){
						if(err){
							console.log("Error on line 149: " + err);
						} else {
							word_array[3] = data;

							// Ugly rank patch & XSS bypass for owners
							if(word_array[1] == "Owner" || word_array[1] == "Co-Owner"){ msg = msg; colour = "red";} else { msg = sanitizer.escape(msg); }
							if(word_array[1] == "Community Manager") { r = "Community_Manager"; colour = "green"; } else if(word_array[1] == "Moderator"){ word_array[1] = "Mod"; colour = "#1a75ff"; } else if(word_array[1] == "Admin"){ colour = "#FF5E00"; } else { r = word_array[1]; }
							if(word_array[1] == "User"){ rank_output = ''; } else { rank_output = '<b style="background-size:15px 53px;-moz-box-shadow: 0 0 3px ' + colour + ';-webkit-box-shadow: 0 0 3px ' + colour + ';box-shadow: 0px 0px 3px ' + colour + ';position:relative;left:3px;top:-2px;color:white; text-align:center;" id="' + word_array[1] + '-bg">&nbsp;' + word_array[1].toUpperCase() + '&nbsp;&nbsp;</b>'; }
							
							if(msg.substring(0,1) == "/"){
								console.log("A moderator took action on something. Let's let them take action. Command: " + msg);
								if(word_array[1] == "Mod" || word_array[1] == "Admin" || word_array[1] == "Owner" || word_array[1] == "Co-Owner" || word_array[1] == "Bob"){
									process_commands(msg, user_id);
								} else {
									console.log("ERROR: Someone without elavated priveleges just tried to execute a command (possibly) " + msg);
									send_chat(msg);
								}
							} else {
								send_chat(msg);
							}
						}
					});
				} else {
					console.log("Someone typed an invalid message. Or something like that.");
				}
			}
		});
	});
});