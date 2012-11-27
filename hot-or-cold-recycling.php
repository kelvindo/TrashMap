<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Hot or Cold</title>
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
		google.setOnLoadCallback(function() {
			var trashToFind = null;
			var trashToFindId = null;
			var oldDistance = null;
			var found = null;

			if (typeof(navigator.geolocation) != 'undefined') {
				var myOptions = {
					zoom: 20,
					mapTypeId: google.maps.MapTypeId.SATELLITE
				};
				var map = new google.maps.Map(document.getElementById("map"), myOptions);
				var marker = null;

				navigator.geolocation.getCurrentPosition(function(position) {
					var firstPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					map.setCenter(firstPosition);
				});
				autoUpdate();	
			} else {
				alert("Cannot Find Location");
			}

			function autoUpdate() {
				navigator.geolocation.getCurrentPosition(function(position) {
					var newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					if (!trashToFind && trashcans) {
						for (var i = 0; i < trashcans.length; i++) {
							var trashPoint = new google.maps.LatLng(trashcans[i].x, trashcans[i].y);
							var testDistance = Math.abs(newPosition.lat() - trashPoint.lat()) + Math.abs(newPosition.lng() - trashPoint.lng());
							if (!oldDistance) {
								oldDistance = testDistance;
								trashToFind = trashPoint;
								trashToFindId = trashcans[i].id;
							} else if (testDistance < oldDistance) {
								oldDistance = testDistance;
								trashToFind = trashPoint;
								trashToFindId = trashcans[i].id;
							}
						}
					}
					if (trashToFind) {
						if ((Math.abs(newPosition.lat() - trashToFind.lat()) < 0.00001) && (Math.abs(newPosition.lng() - trashToFind.lng()) < 0.00001) && !found) {
							$('#found-popup').popup('open');
							$('#found-popup').bind({
								popupafterclose: function(event, ui) {
									console.log('closed popup.');
									console.log(trashId);
									window.location.href = "found-recycling.php?id=" + trashToFindId + "&new=0";
								}
							});
							found = 9;
						}
						var newDistance = Math.abs(newPosition.lat() - trashToFind.lat()) + Math.abs(newPosition.lng() - trashToFind.lng());
						if (newDistance < oldDistance) {
							document.getElementById('textbox').value = 'Getting: HOTTER';
							document.getElementById('img').src = "images/red_therm.jpg";
							console.log("OLDDISTANCE: " + oldDistance + " NEWDISTANCE: " + newDistance);
						} else if (newDistance > oldDistance) {
							document.getElementById('textbox').value = 'Getting: COLDER';
							document.getElementById('img').src = "images/blue_therm.jpg";
							console.log("OLDDISTANCE: " + oldDistance + " NEWDISTANCE: " + newDistance);
						}
						oldDistance = newDistance;
					}
					if (marker) {
						marker.setPosition(newPosition);
					} else {
						var markerImage = new google.maps.MarkerImage("http://imageflock.com/img/1286835864.gif", null, null, null, new google.maps.Size(20, 20));
						marker = new google.maps.Marker({
							position: newPosition,
							map: map,
							icon: markerImage
						});
					}
				});
				setTimeout(autoUpdate, 1000);		
			}
		});	
		</script>
	</head>
	<body>
		<div data-role="page" id="hot-or-cold">
			<div data-role="header">
				<h1>Hot or Cold</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'game-mode-recycling.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( 'hot-or-cold-rules.php', { transition: 'slide' } )">Rules</a>
			</div>
			<div data-role="content">
				<div id="map" style="position:absolute;left:70px;top:62px;right:10px;bottom:120px; text-align:center;"></div>
				<textarea id="textbox" style="position:absolute;left:70px;right:10px;bottom:45px;width:76%;resize:none;text-align:center" readonly="readonly"> Getting: HOTTER </textarea>
				<img id="img" src="images/red_therm.jpg" style="position:absolute;left:10px;top:62px;bottom:45px;" width="50" height="303">
			</div>
			<div data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="#warning-toggle-popup" data-rel="popup" id="trash-toggle">Trash</a></li>
						<li><a href="#" id="recycling-toggle" class="ui-btn-active ui-state-persist">Recycling</a></li>
					</ul>
				</div>
			</div>
			<div data-role="popup" id="warning-toggle-popup" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Warning</h1>
				</div>
				<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					<p>Toggling modes will start a new game. Are you sure?</p> 
					<a href="#" onClick="$.mobile.changePage( 'hot-or-cold-trash.php', { transition: 'none' } )" data-role="button" data-theme="b">Start New Game</a>
					<a href="#" data-role="button" onClick="$('#recycling-toggle').trigger('click');" data-rel="back" data-theme="a">Don't Start New Game</a>
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
