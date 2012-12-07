<?php
	include_once('php/fb_init.php');
	include('config.php');
?>



<!DOCTYPE html>
<html>
	<head>
		<script src="//cdn.optimizely.com/js/140621737.js"></script>
		<title>TrashMap - Menu</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="menu" data-theme="c">
			<div data-role="header">
				<h1>Menu</h1>
				<a data-role="button" class="ui-btn-right" style="text-shadow:none; color: rgb(0, 40, 153); background-color: rgb(195, 228, 254); background-image: -webkit-linear-gradient(top, rgb(255, 255, 255), rgba(241, 241, 241, 0.498039))" onclick="$.mobile.changePage( 'menu-help.php', { transition: 'slide' } )">Help</a>
			</div>
			<div data-role="content">
				<?
					// Adds user to database if not already in
					$user = $facebook->getUser();
					if($user){
						$user_profile = $facebook->api('/me','GET');
						echo "<div style='padding-bottom:10px'>Hello, ".$user_profile['first_name']."!</div>";
						$query = "SELECT * FROM users WHERE fb_id=".$user;
						$result = mysql_query($query);
						if(mysql_num_rows($result) == 0){

							$query = "INSERT INTO `users` (`first_name`, `last_name`, `fb_id`, `points`) 
									VALUES ('".$user_profile['first_name']."', '".$user_profile['last_name']."', ".$user.", 0);";
							mysql_query($query);
						}
					}
				?>


				<a href="game-mode-trash.php" data-role="button" id="game-mode-button">Game Mode</a>
				<a href="quick-find-trash.php" data-role="button" id="quick-find-button" rel="external">Find Nearest Bin</a>
				<a href="account.php" data-role="button" id="my-account-button">My Account</a>


			</div>
		</div>
	</body>
</html>
