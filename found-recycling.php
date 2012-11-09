<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Found Recycling Bin</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

		<?php
		include ("config.php");
		if ($_GET['new'] == 1) {
			$x = $_GET['x'];
			$y = $_GET['y'];
			echo "<script type='text/javascript'>\n";
			echo "var newRecycling = { x: '". $x ."', y: '". $y ."'};\n";
			echo "</script>";
		} else if ($_GET['new'] == 0) {
			$id = $_GET['id'];
			echo "<script type='text/javascript'>\n";
			echo "var newRecycling = { id: '". $id ."'};\n";
			echo "</script>";
		}
		?>

	</head>
	<body>
		<div data-role="page" id="found-recycling-bin">
			<div data-role="header" data-position="fixed">
				<h1>Found Recycling Bin</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'menu.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( 'scavenger-hunt-rules.php', { transition: 'slide' } )">Rules</a>
			</div>
			<div data-role="content" id="found-container">
				<b>CONGRATULATIONS! YOU FOUND RECYCLING BIN!</b><br/><br/>
				You have gained fifty billion trash points for being awesome!111!
			</div>
		</div>
	</body>
</html>