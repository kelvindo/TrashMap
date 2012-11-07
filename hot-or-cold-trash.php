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
		<script type="text/javascript">
		google.setOnLoadCallback(function() {
			var firstPosition = null;
			var trashCans = null;
			var oldDistance = null;
			var found = null;
			var trashPoint = null;

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
					if (firstPosition && !trashCans) {
						trashCans = new Array();
						trashCans[0] = new google.maps.LatLng(firstPosition.lat() + 0.0001, firstPosition.lng() + 0.0001);
						var trashMarker = new google.maps.Marker({
							position: trashCans[0],
							map: map
						});
					}
					var newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					if (trashCans && !trashPoint) {
						trashPoint = trashCans[0];
						oldDistance = Math.abs(firstPosition.lat() - trashPoint.lat()) + Math.abs(firstPosition.lng() - trashPoint.lng());
					}
					if (trashPoint) {
						if ((Math.abs(newPosition.lat() - trashPoint.lat()) < 0.00001) && (Math.abs(newPosition.lng() - trashPoint.lng()) < 0.00001)) {
							if (!found) {
								found = 1;	
								alert("Found It");	
							}
						}
						var newDistance = Math.abs(newPosition.lat() - trashPoint.lat()) + Math.abs(newPosition.lng() - trashPoint.lng());
						if (newDistance < oldDistance) {
							document.getElementById('textbox').value = 'Getting: HOTTER';
							console.log("OLDDISTANCE: " + oldDistance + " NEWDISTANCE: " + newDistance);
						} else if (newDistance > oldDistance) {
							document.getElementById('textbox').value = 'Getting: COLDER';
							console.log("OLDDISTANCE: " + oldDistance + " NEWDISTANCE: " + newDistance);
						}
						oldDistance = newDistance;
						if (!newPosition == firstPosition) {
							console.log("OLD: " + firstPosition + " NEW: " + newPosition);
							firstPosition = newPosition;
						}
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
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'game-mode-trash.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( 'hot-or-cold-rules.php', { transition: 'slide' } )">Rules</a>
			</div>
			<div data-role="content">
				<div id="map" style="position:absolute;left:70px;top:62px;right:10px;bottom:120px; text-align:center;"></div>
				<div style="position:absolute;left:70px;right:10px;bottom:45px;">
					<textarea style="resize:none; text-align:center" readonly="readonly"> Getting:Hotter </textarea>
				</div>
				<div style="position:absolute;left:10px;top:62px;bottom:45px;">
					<img src="http://thumbs.dreamstime.com/thumblarge_575/1295379151Nr67kq.jpg" width="50" height="303">
				</div>
			</div>
			<div data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="#" id="trash-toggle" class="ui-btn-active ui-state-persist">Trash</a></li>
						<li><a href="#warning-toggle-popup" id="recycling-toggle" data-rel="popup">Recycling</a></li>
					</ul>
				</div>
			</div>
			<div data-role="popup" id="warning-toggle-popup" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Warning</h1>
				</div>
				<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					<p>Toggling modes will start a new game. Are you sure?</p> 
					<a href="#" onClick="$.mobile.changePage( 'hot-or-cold-recycling.php', { transition: 'none' } )" data-role="button" data-theme="b">Start New Game</a>
					<a href="#" data-role="button" onClick="$('#trash-toggle').trigger('click');" data-rel="back" data-theme="a">Don't Start New Game</a>
				</div>
			</div>
		</div>
	</body>
</html>