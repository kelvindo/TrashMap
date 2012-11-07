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
		<div data-role="page" id="scavenger-hunt-rules">
			<div data-role="header">
				<h1>Scavenger Hunt Rules</h1>
				<a data-role="button" data-icon="back" data-rel="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">
				<ol>
					<li>The app will locate a trash can or recycling bin for you to find.</li>
					<li>Clues will be presented to you one at a time.</li>
					<li>Once you are within a certain radius of the clue, a popup will notify you to continue onto the next clue.</li>
					<li>Once you have solved the last clue, a popup will notify you to continue, and you will be redirected to the 'found trashcan' page.</li>
				</ol>
				<p>Hint: if you have trouble locating a clue or if you found an alternate trash can, you can always click 'quit' on the left corner to leave the game!</p>
			</div>
		</div>
	</body>
</html>