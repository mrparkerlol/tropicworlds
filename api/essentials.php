<?php
	$crypt = "$2a$09$093402943290ed9e9f08fdf09ds0f8d89989f87dfsfds678$";
	$db = mysqli_connect('localhost','website', 'password');
	$secret = "6LdnPxITAAAAAF1_HITiFse0dGPXspO8nxiKPUnv";
	$badwords = array('c0ck','f7ck','biotch','g@y','shiit','ballsack','&shy','hitler','fuck','cunt','sex','nigger','bitch','nigga','nig','fag','xhamster','redtube','feg','f4k','clit','bollocks','chesticle','@ss','milf','kum','fack','f4ck','sht','masturbate','penis','vagina','dick','pussy','anal','ebony','lesbian','porn','boobs','gay','titties','booty','shit','spunk','cum','horny','cock','homo','cancer','aids','fk','fuk','fuc','arse','axwound','coon','queef','queer','hump','spick','whore','spung','spooge','sperm','hoe','rimjob','rectum','titty','tit','handjob','threesome','kunt','foreskin','rum','masturbait','nutsack','jizz','dong','douche','cawk','chode','gangbang','bewb','bestiality','beastiality','abortion','skeet','slut','cuck','masterbiat','wang','rape','testicle','testicular','a55','kush','weed','w33d','dildo','d1ldo','d1ld0','anus','69','Klux','kkk'.'Jesus','allah','ackbar','autistic','autism','drunk','beer','kill','pedo','p0rn','f4ck','meatspin','splerge','meep','4llah','4ckbar','semen','dyke','dike','nazi','jew','adolf','hitler','masturbation','erection','boner','b0ner','b0n3r','hentai','butt plug','clitorus','chink','Joseph Stalin','jerk off','kike','negro','muff','cootie','wank','communist','communism','comcast','twat','vajayjay','vag','catholic','minch','nut sack', 'pussies', 'lesbo', 'kraut', 'kyke', 'damn', 'damm', 'prostate', 'viagra', 'cialis', 'p3nis', 'p3n1s', 'condom', 'rapist');

	//Functions
	function filter_word($string,$banned_words) {
	    foreach($banned_words as $banned_word) {
	        if(stristr($string, $banned_word)){
	            return false;
	        }
	    }
	    return true;
	}

	function getCurlData($url){
		$curl = curl_init();

		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_TIMEOUT,10);
		curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");

		$curlData = curl_exec($curl);
		curl_close($curl);

		return $curlData;
	}
?>
