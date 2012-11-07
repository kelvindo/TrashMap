<?php
	include_once('php/fb_init.php');

// See if there is a user from a cookie
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

		<style type="text/css">
			body {
				background: url('http://i.imgur.com/zNTdD.png');
			}
			.ui-page {
				background: transparent;
			}
			
			.ui-content {
				background: transparent;
			}
		</style>
	</head>
	<body>
		<script>
			alert('<?php echo $user ?>');
		</script>
	
		<div data-role="page" id="menu" data-theme="c">
			<div data-role="header">
				<h1>Menu</h1>
			</div>
			<div data-role="content">		
				<a data-role="button" onClick="$.mobile.changePage( 'game-mode.php', { transition: 'pop' } );">Game Mode</a>
				<a data-role="button" onClick="$.mobile.changePage( 'quick-find.php', { transition: 'pop' } );">Quick Find</a>
				<a data-role="button" onClick="$.mobile.changePage( 'account.php', { transition: 'pop' } );">My Account</a>
			</div>
		</div>
	</body>
</html>