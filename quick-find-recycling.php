<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Quick Find</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		<script src="http://www.google.com/jsapi?key=AIzaSyDUGIMFHD0MoPLaGQFQUwWBFwPr3zTVWIg&autoload=%7Bmodules%3A%5B%7Bname%3A%22maps%22%2Cversion%3A3%2Cother_params%3A%22sensor%3Dtrue%22%7D%5D%7D"></script>

		<?php
		include ("config.php");
		$query = "SELECT * FROM trashcans WHERE type='recycle'";
		$result = mysql_query($query);
		
		echo "<script type='text/javascript'>\n";
		echo "var trashcans = new Array();\n";
		
		while($row = mysql_fetch_array($result)) {
			echo "trashcans[trashcans.length] = { x: '". $row['x'] ."', y: '". $row['y'] ."', id: '". $row['T_Id'] ."'};\n";
		}
		echo "</script>";
		?>

		<script type="text/javascript">
		var currentPos = null;
		google.setOnLoadCallback(function() {
			var gotCans = null;
			var firstPosition = null;
			var found = null;

			if (typeof(navigator.geolocation) != 'undefined') {
				var myOptions = {
					zoom: 20,
					mapTypeId: google.maps.MapTypeId.SATELLITE
				};
				var map = new google.maps.Map(document.getElementById("map"), myOptions);
				var marker = null;

				navigator.geolocation.getCurrentPosition(function(position) {
					firstPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					map.setCenter(firstPosition);
				});
				autoUpdate();	
			} else {
				alert("Cannot Find Location");
			}

			function autoUpdate() {
				navigator.geolocation.getCurrentPosition(function(position) {
					if (!gotCans && trashcans) {
						gotCans = true;
						for (var i = 0; i < trashcans.length; i++) {
							var trashPoint = new google.maps.LatLng(trashcans[i].x, trashcans[i].y);
							var markerImage = new google.maps.MarkerImage("images/trash-marker.png", null, null, null, new google.maps.Size(20, 20));
							var trashMarker = new google.maps.Marker({
								position: trashPoint,
								map: map,
								icon: markerImage
							});
						}
					}
					var newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					if (gotCans) {
						for (var i = 0; i < trashcans.length; i++) {
							var trashPoint = new google.maps.LatLng(trashcans[i].x, trashcans[i].y);
							var trashId = trashcans[i].id;
							if ((Math.abs(newPosition.lat() - trashPoint.lat()) < 0.00001) && (Math.abs(newPosition.lng() - trashPoint.lng()) < 0.00001) && !found) {
								$('#found-popup').popup('open');
								$('#found-popup').bind({
									popupafterclose: function(event, ui) {
										console.log('closed popup.');
										window.location.href = "found-recycling.php?id=" + trashId + "&new=0";
									}
								});
								found = 9;	
							}
						}
						if (!newPosition == firstPosition) {
							console.log("OLD: " + firstPosition + " NEW: " + newPosition);
							firstPosition = newPosition;
						}
					}
					if (marker) {
						marker.setPosition(newPosition);
					} else {
						var markerImage = new google.maps.MarkerImage("images/blueman.png", null, null, null, new google.maps.Size(20, 20));
						marker = new google.maps.Marker({
							position: newPosition,
							map: map,
							icon: markerImage
						});
					}
					currentPos = newPosition;
				});
				setTimeout(autoUpdate, 5000);		
			}
		});
		function addRecyclingBin() {
			$('#found-popup').popup('open');
			$('#found-popup').bind({
				popupafterclose: function(event, ui) {
					window.location.href = "found-recycling.php?x=" + currentPos.lat() + "&y=" + currentPos.lng() + "&new=1";
				}
			});
		}
		</script>
	</head>
	<body>
		<div data-role="page" id="quick-find">
			<div data-role="header">
				<h1>Quick Find</h1>
				<a data-role="button" href="menu.php" data-icon="home">Menu</a>
				<a data-role="button" onclick="addRecyclingBin()">Add Here <img src="images/recycling-marker.png" height="13px" width="11px"/></a>
			</div>
			<div data-role="content">		
				<div id="map" style="position:absolute;left:0px;top:42px;right:0px;bottom:35px;"></div>
			</div>
			<div data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="quick-find-trash.php" rel="external">Trash</a></li>
						<li><a href="#" class="ui-btn-active ui-state-persist">Recycling</a></li>
					</ul>
				</div>
			</div>
			<div data-role="popup" id="found-popup" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>You found it!</h1>
				</div>
				<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					<p>You have located the recycling bin!</p> 
					<a href="#" onClick="$('#found-popup').popup('close')" data-role="button" data-theme="b">Continue</a>
				</div>
			</div>
		</div>
	</body>
</html>
