<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Scavenger Hunt</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="scavenger-hunt-found">
			<div data-role="header" data-position="fixed">
				<h1>Scavenger Hunt</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'game-mode.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( 'scavenger-hunt-rules.php', { transition: 'slide' } )">Rules</a>
			</div>
			<div data-role="content" id="found-container">
				<b>CONGRATULATIONS! YOU FOUND TRASHCAN!</b>
			</div>
		</div>
	</body>
</html>