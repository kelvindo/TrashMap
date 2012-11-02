<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Leaderboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="leaderboard" data-theme="c">
			<div data-role="header">
				<h1>Leaderboard</h1>
				<a data-role="button" data-rel="back" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">		
				<ol data-role="listview">
					<?php
						include("config.php");		
	
						$query = "SELECT * FROM users ORDER BY -users.points";
						$result = mysql_query($query);
						echo "<h1>Leaderboard</h1>";
						while ($row = mysql_fetch_assoc($result)) {
							echo "<li>".$row["first_name"]." ".$row["last_name"]." ".$row["points"]." points</li>";
						} 
						?>
				</ol>
			</div>
		</div>
	</body>
</html>
