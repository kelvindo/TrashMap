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
		<div data-role="page" id="trash-history-map" data-theme="c">
			<div data-role="header">
				<h1>Trash History</h1>
				<a data-role="button" href="account.php" data-icon="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">		
				<img src="http://i.imgur.com/xUfwU.gif" alt="Your Trash History" width=100% height=90%>
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
