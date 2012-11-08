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
		<script type="text/javascript">
		google.setOnLoadCallback(function() {
			var firstPosition = null;
			var trashCans = null;
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
					}
					if (trashPoint) {
						if ((Math.abs(newPosition.lat() - trashPoint.lat()) < 0.00001) && (Math.abs(newPosition.lng() - trashPoint.lng()) < 0.00001)) {
							if (!found) {
								found = 1;	
								alert("Found It");	
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
		<div data-role="page" id="quick-find">
			<div data-role="header">
				<h1>Quick Find</h1>
				<a data-role="button" href="menu.php" data-icon="home">Menu</a>
			</div>
			<div data-role="content">		
				<div id="map" style="position:absolute;left:0px;top:42px;right:0px;bottom:35px;"></div>
			</div>
			<div data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="quick-find-trash.php">Trash</a></li>
						<li><a href="#" class="ui-btn-active ui-state-persist">Recycling</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>