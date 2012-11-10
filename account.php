<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - My Account</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="account">
			<div data-role="header">
				<h1>My Account</h1>
				<a data-role="button" href="menu.php" data-icon="home">Menu</a>
				<a data-role="button" data-icon="gear" data-iconpos="notext" href="settings.php"></a>
			</div>
			<div data-role="content">		
				<a data-role="button" onClick="$.mobile.changePage( 'achievements.php', { transition: 'pop' } );">Achievements</a>
				<a data-role="button" onClick="$.mobile.changePage( 'leaderboard.php', { transition: 'pop' } );">Leaderboard</a>
				<a data-role="button" onClick="$.mobile.changePage( 'trash-history-text.php', { transition: 'pop' } );">Trash History</a>
			</div>
		</div>
	</body>
</html>
