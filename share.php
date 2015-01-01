<?php
	if(!(isset($_REQUEST['tileData'])) or empty ($_REQUEST['tileData'])){
	    die ('Je browser geeft helaas geen afbeeldinggegevens door.');
	}
	
	$tileData = $_REQUEST['tileData'];
	$coor_x = (int)$_REQUEST['coor_x'];
	$coor_y = (int)$_REQUEST['coor_y'];
	// echo $coor_x;
	
	$im = createImgFromData ( $tileData );
	if ($im === false) 
	{
	    die ('Je browser geeft helaas geen afbeeldinggegevens door.');
	}
	
	$dirname = 'pltjes';
	$afbNaam = $dirname . '/afb' . $coor_x . '_' . $coor_y . '.png';
	
	saveImg ( $im, $afbNaam );
	// displayImg ( $im );
    // imagedestroy($im);
	
	function createImgFromData ( $data )
	{
		return imagecreatefromstring( fixDataURLImg ( $data ) );
	}
	
	function displayImg ( $im )
	{
	    header('Content-Type: image/png');
	    imagepng($im);
	}
	
	function fixDataURLImg ( $d )
	{
		// data afkomstig van canvas.toDataURL("image/png")
		// begint met data:image/png;base64,
		// dit halen we eraf
		$d = substr ( $d, strpos ( $d, "," ) + 1 );
		
		// decode
		return base64_decode ( $d );
	}
	
	function saveImg ( $im, $name )
	{
	    imagepng($im, $name );
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>share</title>
		<meta name="description" content="" />
		<meta name="generator" content="Studio 3 http://aptana.com/" />
		<meta name="author" content="Roelof" />

		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		
		<link rel="stylesheet" href="css/destijl.css" type="text/css" media="screen"/>	
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		
		$(document).ready(function(){
		$('#share_button').click(function(e){
		e.preventDefault();
		FB.ui(
		{
		method: 'feed',
		name: 'Een kaleidoscopische estafette.',
		link: 'http://www.potatodie.nl/graphics/canvas/kaleidoscope.php?x=<?=$coor_x?>&y=<?=$coor_y?>',
		picture: 'http://www.potatodie.nl/graphics/canvas/<?= $afbNaam ?>',
		caption: 'Klik op de thumbnail om patroon groter te bekijken en aan te passen.',
		description: 'Patronen maken met een webapplicatie op basis van html5 met canvas (niet voor Internet Explorer < 9) ',
		message: ''
		});
		});
		});
		</script>
	</head>

	<body>
		<div id="wrap">
			<img src="<?= $afbNaam ?>" style="float:left; margin-right:1em;">
			<p style="text-align:left;">
				OK, dit tussenschermpje is misschien overbodig, daar kijk ik nog naar. 
				Wel handig om eventueel het plaatje te bewaren!
				(Sleep het naar je desktop of zo.)

				<!-- Laat user tekst etc. aanpassen -->
			</p>
			<div id="fb-root"></div>
			<script>
			window.fbAsyncInit = function() {
			FB.init({appId: 139580816122385, status: true, cookie: true,
			xfbml: true});
			};
			(function() {
			var e = document.createElement('script'); e.async = true;
			e.src = document.location.protocol +
			'//connect.facebook.net/en_US/all.js';
			document.getElementById('fb-root').appendChild(e);
			}());
			</script>
			<img src="fshare.jpg" id="share_button" alt="share" style="cursor:pointer;">
			<p>Terug naar de <a href="kaleidoscope.php?x=<?=$coor_x?>&y=<?=$coor_y?>">tool</a>.</p>
		</div>
	</body>
</html>