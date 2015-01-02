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
			<a href="/"><figure id="icon"></figure></a>
			<h2>Drag the <span>red square</span> over the left-hand image.</h2>
			<div id="container">
				<div id="draggable" class="ui-widget-content"></div>
				<img src="hazelaar.jpg" width="300" height="488" alt="hazelaar">
			</div>
			<canvas id="canvas" width="300" height="488"></canvas>
		</div>
	</body>
</html>
