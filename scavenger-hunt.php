<!DOCTYPE html>
<html>
	<head>
		<title>TrashMap - Scavenger Hunt</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="layout.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	</head>
	<body>
		<div data-role="page" id="scavenger-hunt">
			<div data-role="header" data-position="fixed">
				<h1>Scavenger Hunt</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'game-mode.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( '#rules', { transition: 'slide' } )">Rules</a>
			</div>
			<div data-role="content" class="clue-container">
				<b>CLUE ONE</b>: Find the tallest tower in the area.
				<div id="next-clue-button1" data-rel="popup" data-role="button" data-transition="pop">Next Clue</div>
			</div>
			<div data-role="popup" id="next-clue-popup1" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Congrats!</h1>
				</div>
				<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					<p>You found the next clue! You are one step closer to your target. Click 'Continue' to continue.</p>   
					<a href="#" data-role="button" data-rel="back" data-transition="flow" data-theme="b">Continue</a>  
				</div>
			</div>
		</div>
						
		<div data-role="page" id="clue-two">
			<div data-role="header" data-position="fixed">
				<h1>Scavenger Hunt</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'game-mode.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( '#rules', { transition: 'slide' } )">Rules</a>
			</div>
			<div data-role="content" class="clue-container">
				<b>CLUE TWO</b>: Find the round stone where whispers can travel.
				<div id="next-clue-button2" data-role="button" data-transition="pop">Next Clue</div>	
			</div>
			<div data-role="popup" id="next-clue-popup2" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Congrats!</h1>
				</div>
				<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					<p>You found the next clue! You are super duper close to your target. Click 'Continue' to continue.</p>   
					<a href="#" data-role="button" data-rel="back" data-transition="flow" data-theme="b">Continue</a>  
				</div>
			</div>
		</div>
		
		<div data-role="page" id="found">
			<div data-role="header" data-position="fixed">
				<h1>Scavenger Hunt</h1>
				<a data-role="button" data-icon="delete" onclick="$.mobile.changePage( 'game-mode.php', { transition: 'pop' } )">Quit</a>
				<a data-role="button" onclick="$.mobile.changePage( '#rules', { transition: 'slide' } )">Rules</a>
			</div>
			<div data-role="content" id="found-container">
				<b>CONGRATULATIONS! YOU FOUND TRASHCAN!</b>
			</div>
		</div>
		
		<div data-role="page" id="rules">
			<div data-role="header">
				<h1>Scavenger Hunt Rules</h1>
				<a data-role="button" data-icon="back" data-rel="back" data-iconpos="notext"></a>
			</div>
			<div data-role="content">
				<ol>
					<li>The app will locate a trash can or recycling bin for you to find.</li>
					<li>Clues will be presented to you one at a time.</li>
					<li>Once you are within a certain radius of the clue, a popup will notify you to continue onto the next clue.</li>
					<li>Once you have solved the last clue, a popup will notify you to continue, and you will be redirected to the 'found trashcan' page.</li>
				</ol>
				<p>Hint: if you have trouble locating a clue or if you found an alternate trash can, you can always click 'quit' on the left corner to leave the game!</p>
			</div>
		</div>
	
		<script>
			$( document ).ready(function() {
				$("#next-clue-button1").click(function() {
					$("#next-clue-popup1").popup( "open" );
				});
				$("#next-clue-popup1").on({
					popupafterclose: function() {
   						$.mobile.changePage( '#clue-two', { transition: 'none' } );
   					}
				});
				$("#next-clue-button2").click(function() {
					$("#next-clue-popup2").popup( "open" );
				});
				$("#next-clue-popup2").on({
					popupafterclose: function() {
   						$.mobile.changePage( '#found', { transition: 'none' } );
   					}
				});
			});
		</script>
		<!-- check location of place. If within a certain radius, then call the popup? );
	</body>
</html>