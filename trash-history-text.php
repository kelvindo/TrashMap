<?php include("php/fb_init.php");?>
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
		<div data-role="page" id="trash-history-text" data-theme="c">
			<div data-role="header">
				<h1>Trash History</h1>
				<a data-role="button" href="account.php" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">		
				

			<table>
				<?php
					include("config.php");

					$user = $facebook->getUser();
					if($user){
						$query = "SELECT DISTINCT t. * , u. * , ta.time_created
									FROM  `trashcans` t
									INNER JOIN trash_activity ta ON ta.T_Id = t.T_Id
									INNER JOIN users u ON u.U_Id = ta.U_Id
									WHERE u.fb_id=$user";
						$result = mysql_query($query);
						while ($row = mysql_fetch_assoc($result)) {
							echo "<tr><td><h2>Trashcan at (".$row["x"].", ".$row["y"].") found on ".$row["time_created"]."</h2>";
							//echo "<p class='author'>Points: ".$row["points"]."</p>";
							//echo "<td><img width='100' class='pretty' src='".$row["image"]."' /></td></td>";
						} 
					}
					?>
			</table>

			</div>
			<div data-role="footer" data-position="fixed" data-id="trash-history-footer">
				<div data-role="navbar">
					<ul>
						<li><a href="#" data-prefetch="true" class="ui-btn-active ui-state-persist">Text</a></li>
						<li><a href="trash-history-map.php" data-prefetch="true">Map</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>