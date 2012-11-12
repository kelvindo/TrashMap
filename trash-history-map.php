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
		<script src="http://www.google.com/jsapi?key=AIzaSyDUGIMFHD0MoPLaGQFQUwWBFwPr3zTVWIg&autoload=%7Bmodules%3A%5B%7Bname%3A%22maps%22%2Cversion%3A3%2Cother_params%3A%22sensor%3Dtrue%22%7D%5D%7D"></script>

		<?php
		include ("config.php");
		$user = $facebook->getUser();
		if($user){
			$query = "SELECT DISTINCT t.*, u.*
					FROM   `trashcans` t
						   INNER JOIN trash_activity ta
							 ON ta.T_Id = t.T_Id
						   INNER JOIN users u
							 ON u.U_Id = ta.U_Id
							WHERE u.fb_id=$user";
			$result = mysql_query($query);
		
			echo "<script type='text/javascript'>\n";
			echo "var trashcans = new Array();\n";
		
			while($row = mysql_fetch_array($result)) {
				echo "trashcans[trashcans.length] = { x: '". $row['x'] ."', y: '". $row['y'] ."', id: '". $row['T_Id'] ."'};\n";
			}
			echo "</script>";
		}
		?>

		<script type="text/javascript">
		google.setOnLoadCallback(function() {
			var myOptions = {
				zoom: 4,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("map"), myOptions);
			if (typeof(navigator.geolocation) != 'undefined') {
				navigator.geolocation.getCurrentPosition(function(position) {
					firstPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					map.setCenter(firstPosition);
				});
			}
			waitForTrashCans();

			function waitForTrashCans() {
				if (trashcans) {
					for (var i = 0; i < trashcans.length; i++) {
						var trashPoint = new google.maps.LatLng(trashcans[i].x, trashcans[i].y);
						var markerImage = new google.maps.MarkerImage("images/trash-marker.png", null, null, null, new google.maps.Size(20, 20));
						var trashMarker = new google.maps.Marker({
							position: trashPoint,
							map: map,
							icon: markerImage
						});
					}
				} else {
					setTimeout(waitForTrashCans, 1000);
				}
			}
		});

		</script>
	</head>
	<body>
		<div data-role="page" id="trash-history-map" data-theme="c">
			<div data-role="header">
				<h1>Trash History</h1>
				<a data-role="button" href="account.php" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">		
				<div id="map" style="position:absolute;left:0px;top:42px;right:0px;bottom:35px;"></div>
			</div>
			<div data-role="footer" data-position="fixed" data-id="trash-history-footer">
				<div data-role="navbar">
					<ul>
						<li><a href="trash-history-text.php" data-prefetch="true">Text</a></li>
						<li><a href="#" data-prefetch="true" class="ui-btn-active ui-state-persist">Map</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>