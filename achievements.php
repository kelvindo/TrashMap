<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Achievements</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="achievements" data-theme="c">
			<div data-role="header">
				<h1>Achievements</h1>
				<a data-role="button" data-rel="back" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">
				<p>You don't have any achievements right now! Go find trashcans to get some!</p>
				<br>	
				<ul data-role="listview">
					<?php
						include("config.php");		
	
						$query = "SELECT * FROM achievements";
						$result = mysql_query($query);
		
						echo "<h1>List of Achievements</h1>";
						while ($row = mysql_fetch_assoc($result)) {
							echo "<li><h2>".$row["name"]."</h2>";
							echo "<p>".$row["description"]."</p> <p>Worth: ".$row["point_worth"]." points</p></li>";
						} 
					?>
				</div>
			</div>
		</div>
	</body>
</html>
