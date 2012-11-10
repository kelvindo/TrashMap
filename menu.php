<?php
	include_once('php/fb_init.php');
	include('config.php');
?>



<!DOCTYPE html>
<html>
	<head>
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


				<a data-role="button" onClick="$.mobile.changePage( 'game-mode-trash.php', { transition: 'pop' } );">Game Mode</a>
				<a data-role="button" onClick="$.mobile.changePage( 'quick-find-trash.php', { transition: 'pop' } );">Quick Find</a>
				<a data-role="button" onClick="$.mobile.changePage( 'account.php', { transition: 'pop' } );">My Account</a>


			</div>
		</div>
	</body>
</html>
