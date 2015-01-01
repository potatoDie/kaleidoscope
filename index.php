<?php
/*
 * kaleidoscope/index.php.
 * 
 * Less pages. Do the same.
 * Use Ajax and display on/off to do all in 1 page (like an App!)
 * Just before you open the facebook dialog (this pop-up is allowed I think) save the image,
 * so the pop-up shows the preview.
 * So you just need 1 fb button, save the image (ajax) and on succes open fb pop-up
 * 
 */

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="main.css" type="text/css" media="screen"/>		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.15.0/TweenMax.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.15.0/utils/Draggable.min.js"></script>

		<script type="text/javascript">
			// Transfer php variables to js
			<?php	if ( isset ( $_GET['x'] ) && isset ( $_GET['y'])): ?>
				var start_x = <?= (int) $_GET['x'] ?>;
				var start_y = <?= (int) $_GET['y'] ?>;
			<?php endif; ?>

		</script>

		<script type="text/javascript" src="main.js"></script>		
	</head>
	<body>
		<div id="wrap">
			<p>Sleep het vierkantje over de linker afbeelding.</p>
			<div id="container">
				<div id="draggable" class="ui-widget-content"></div>
				<img src="hazelaar.jpg" width="300" height="488" alt="hazelaar">
			</div>
			<canvas id="canvas" width="300" height="488"></canvas>

			<form action="share.php" method="post" onsubmit="getTileData()">
				<input type="submit" value="Deel je ontwerp op" class="share">		
				<input type="hidden" id="tileData" name="tileData">		
				<input type="hidden" id="coor_x" name="coor_x">		
				<input type="hidden" id="coor_y" name="coor_y">		
			</form>
			<input type="button" value="Deel je ontwerp op">		

		</div>
	</body>
</html>
