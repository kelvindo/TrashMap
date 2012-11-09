<?php
	include_once('php/fb_init.php');

// See if there is a user from a cookie
	$user = $facebook->getUser();
?>

<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<title>TrashMap - Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<meta property="og:title" content="TrashMap" />
  		<meta property="og:type" content="website" />
  		<meta property="og:site_name" content="TrashMap" />
  		<meta property="og:description" content="TrashMap is a fun and social app that helps you find the nearest trash can or recycling bin!" />
  		<meta property="og:image" content="http://www.facebookmobileweb.com/hackbook/img/facebook_icon_large.png"/>
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	</head>
  	<body>
  	
	  	<div data-role="page" id="login" data-theme="c">
			<div data-role="header"><h1>Login page</h1></div>
			<div data-role="content">
			   	<div data-role="button" onClick="loginUser();">Login with Facebook</div>
				<a data-role="button" onClick="$.mobile.changePage( 'menu-nofb.php', { transition: 'pop' } );">Not Now</a>
			</div>
		</div>
		
	    <script>
	    	window.fbAsyncInit = function() {
	        	FB.init({
	          		appId: '<?php echo $facebook->getAppID() ?>',
	          		cookie: true,
	          		xfbml: true,
	          		oauth: true
	        	});
	        
	        			 
				FB.Event.subscribe('auth.statusChange', handleStatusChange);	
					   
				FB.getLoginStatus(function(response) {
			    	if (response.status === 'connected') {
			    		$.mobile.changePage( "menu.php", { transition: "pop" } );
			    	} 
			    });
		   	};
		   	(function(d){
		    	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		     	if (d.getElementById(id)) {return;}
		    	js = d.createElement('script'); js.id = id; js.async = true;
		     	js.src = "//connect.facebook.net/en_US/all.js";
		     	ref.parentNode.insertBefore(js, ref);
		    }(document));
		
			function loginUser() {    
		   		FB.login(function(response) { 
		   			if (response.authResponse) {
		   				$.mobile.changePage( "menu.php", { transition: "pop"} );
		   			}
		   		}, {scope:'email'});
		    }
		    
		    function handleStatusChange(response) {
		    	document.body.className = response.authResponse ? 'connected' : 'not_connected';
		    
		     	if (response.authResponse) {
		       		console.log(response);
		     	}
		   	}
		   	
	    </script>
	</body>
</html>