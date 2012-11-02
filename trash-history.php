<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Trash History</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="trash-history" data-theme="c">
			<div data-role="header">
				<h1>Trash History</h1>
				<a data-role="button" data-rel="back" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">		
				

			<table>
				<?php
					include("config.php");
/*
					$date = date("Y-m-d H:i:s");
					echo $date;
					$query = "INSERT INTO `trash_activity` (`U_Id`, `T_Id`, `time_created`) VALUES (1, 1, NOW())";
					mysql_query($query);
*/					

					$query = "SELECT trashcans.x, trashcans.y, trash_activity.time_created
								FROM trashcans
								INNER JOIN trash_activity
								ON trashcans.T_Id=trash_activity.T_Id
								ORDER BY trash_activity.time_created;";
					$result = mysql_query($query);
					while ($row = mysql_fetch_assoc($result)) {
						echo "<tr><td><h2>Trashcan ".$row["x"]." ".$row["y"]." found on ".$row["time_created"]."</h2>";
						//echo "<p class='author'>Points: ".$row["points"]."</p>";
						//echo "<td><img width='100' class='pretty' src='".$row["image"]."' /></td></td>";
					} 
					?>
			</table>

			</div>
		</div>
	</body>
</html>
