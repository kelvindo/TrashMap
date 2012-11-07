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
		<div data-role="page" id="scavenger-hunt">
			<div data-role="header" data-position="fixed">
				<h1>Scavenger Hunt</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'game-mode-recycling.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( 'scavenger-hunt-rules.php', { transition: 'none' } )">Rules</a>
			</div>
			<div data-role="content" class="clue-container">
				<b>CLUE TWO</b>: Find the round stone where whispers can travel.
				<a href="#next-clue-popup2" id="next-clue-button1" data-rel="popup" data-role="button" data-transition="pop">Next Clue</a>
			</div>
			<div data-role="popup" id="next-clue-popup2" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Congrats!</h1>
				</div>
				<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					<p>You found the next clue! You are one step closer to your target. Click 'Continue' to continue.</p>   
					<a data-prefetch="true" onClick="$.mobile.changePage( 'found.php', { transition: 'none' } );" data-role="button" data-transition="flow" data-theme="b">Continue</a>  
				</div>
			</div>
		</div>

		<!-- check location of place. If within a certain radius, then call the popup? );
	</body>
</html>