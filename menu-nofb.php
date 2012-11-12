<?php
	include_once('php/fb_init.php');
	include('config.php');
	setcookie('fbs_'.$facebook->getAppId(), '', time()-100, '/', 'domain.com');
	session_destroy();
	$user = $facebook->getUser();
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
				<a data-role="button" onClick="$.mobile.changePage( 'game-mode-trash.php', { transition: 'pop' } );">Game Mode</a>
				<a data-role="button" onClick="$.mobile.changePage( 'quick-find-trash.php', { transition: 'pop' } );">Quick Find</a>
				<a data-role="button" href="login.php">Log in</a> 
				<?php echo $user; ?>
			</div>
		</div>
	</body>
</html>
