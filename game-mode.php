<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Game Mode</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="game-mode">
			<div data-role="header">
				<h1>Game Mode</h1>
				<a data-role="button" data-icon="home" onclick="$.mobile.changePage( 'menu.php', { transition: 'pop' } );">Menu</a>
			</div>
			<div data-role="content">		
				<a data-role="button" onClick="$.mobile.changePage( 'scavenger-hunt.php', { transition: 'pop' } );">Scavenger Hunt</a>
				<a data-role="button" onClick="$.mobile.changePage( 'hot-or-cold.php', { transition: 'pop' } );">Hot or Cold</a>
			</div>
			<div data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="#" class="ui-btn-active ui-state-persist">Trash</a></li>
						<li><a href="#">Recycling</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>