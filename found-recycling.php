<?php
	include_once('php/fb_init.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Found Recycling Bin</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

		<?php
		include ("config.php");
		if ($_GET['new'] == 1) {
			$x = $_GET['x'];
			$y = $_GET['y'];
			echo "<script type='text/javascript'>\n";
			echo "var newRecycling = { x: '". $x ."', y: '". $y ."'};\n";
			echo "</script>";
			$query = "INSERT INTO `trashcans` (`x`, `y`, `type`) VALUES ($x, $y, 'recycle');";
			mysql_query($query);
			$id = mysql_insert_id();
		} else if ($_GET['new'] == 0) {
			$id = $_GET['id'];
			echo "<script type='text/javascript'>\n";
			echo "var newRecycling = { id: '". $id ."'};\n";
			echo "</script>";
		}
		
		$user = $facebook->getUser();
		if ($user) {
			$result = mysql_query("SELECT U_Id FROM `users` WHERE fb_id=".$user.";");
			$row = mysql_fetch_assoc($result);
			$U_Id = $row["U_Id"];
			$query = "INSERT INTO `trash_activity` (`U_Id`, `T_Id`, `time_created`) 
						VALUES ($U_Id, $id, NOW());";
			mysql_query($query);
			$query = "UPDATE `users` SET points = points+30 WHERE fb_id=$user;";
			mysql_query($query);
		}
		?>

	</head>
	<body>
		<div data-role="page" id="found-recycling">
			<div data-role="header" data-position="fixed">
				<h1>Bin Found!</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'menu.php', { transition: 'pop' } )">Quit</a>
			</div>
			<div data-role="content" id="found-container">
				<b>You found the trashcan!</b><br/><br/>
				<?php 
					if ($user) {
						$result = mysql_query("SELECT * FROM `users` WHERE U_Id=$U_Id;");
						$row = mysql_fetch_assoc($result);
						$points = $row["points"];
						echo "You got 30 trash points! Now you have $points points!"; 
					}
				?>
			</div>
		</div>
	</body>
</html>
