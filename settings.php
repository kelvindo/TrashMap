<?php
	include_once('php/fb_init.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - My Account</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		
		<script src="http://connect.facebook.net/en_US/all.js"></script>
		<script type="text/javascript">
			window.fbAsyncInit = function() {
				FB.init({
	          		appId: '375003062578548',
	          		cookie: true,
	          		xfbml: true,
	          		oauth: true
	        	});  	
			}
			
		</script>

	</head>
	<body>
		<div id="fb-root"></div>
		<div data-role="page" id="settings">
			<div data-role="header">
				<h1>Settings</h1>
				<a data-role="button" href="account.php" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">
				<ul data-role="listview">
					<li><a href="#about">About</a></li>
					<li><a href="#privacy">Privacy</a></li>
					<li><a href="javascript:FB.logout();void(0)">Log Out</a></li>
				</ul>
			</div>
		</div>
		
		<div data-role="page" id="about">
			<div data-role="header">
				<h1>About</h1>
				<a data-role="button" data-rel="back" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">
				This app is super duper cool and if you were super duper cool, you'd use it to help the environment too, woot!
			</div>
		</div>
		
		<div data-role="page" id="privacy">
			<div data-role="header">
				<h1>Privacy</h1>
				<a data-role="button" data-rel="back" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">
				By using this app, you agree to give up all your privacy to TrashMap, Inc., and Kevin Lu the noob will sell all your personal information to help the environment! Yay!
			</div>
		</div>
	</body>
</html>