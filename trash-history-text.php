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
				

			<ul data-role="listview">
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
						if(mysql_num_rows($result) == 0) {
							echo "<br><h>You haven't visited any bins yet!</h>";
						}
						while ($row = mysql_fetch_assoc($result)) {
							if ($row['type'] == 'trash') {
								echo "<li>
									<img src='images/trash-marker.png' style='padding-left: 10px; padding-top: 10px;'/>
									<h3>Trash can found on </h3>
									<p>".$row['time_created']."</p>
								</li>";
							} else {
								echo "<li>
									<img src='images/recycling-marker.png' style='padding-left: 10px; padding-top: 10px;'/>
									<h3>Recycle Bin found on </h3>
									<p>".$row['time_created']."</p>
								</li>";
							}
							// (".$row["x"].", ".$row["y"].") 
							//echo "<p class='author'>Points: ".$row["points"]."</p>";
							//echo "<td><img width='100' class='pretty' src='".$row["image"]."' /></td></td>";
						} 
					} else {
						echo "<br><h>Login to save your history!</h>";
					}
					?>
			</ul>

			</div>
			<div data-role="footer" data-position="fixed" data-id="trash-history-footer">
				<div data-role="navbar">
					<ul>
						<li><a href="#" data-prefetch="true" class="ui-btn-active ui-state-persist">Text</a></li>
						<li><a href="trash-history-map.php" data-prefetch="true" rel="external">Map</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>
