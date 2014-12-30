$(function() {
	// Setup kaleidoscope with dom elements and perhaps start coordinates
	var kaleidoscope = new Kaleidoscope90 ( {
		peephole: document.getElementById('draggable'),
		original: $("#container img")[0],
		outputCanvas: document.getElementById('canvas'),
		x: (typeof start_x === 'undefined') ? 92 : start_x,
		y: (typeof start_y === 'undefined') ? 132 : start_y
	});

	$("input[type='button']").on('click', 
		function() {
			// Save img
			// if succes, open fb pop up
			console.log ( 'klik' )
		}
	);
});

/**
 * Kaleidoscope90 repeats a reflected and rotated square (tile)
 * Initialize it with the necessary DOM elements
 */
var Kaleidoscope90 = function ( options ) {
	var $peephole,
			peepholeWidth,
			peepholeHeight,
			original,
			outputCtx,
			tileCanvas,
			tileCanvasCtx;

	init( options );
	
	function init ( options ) {
		$peephole = $(options.peephole);
		peepholeWidth = $peephole.width();
		peepholeHeight = $peephole.height();
		original = options.original;
		outputCtx = options.outputCanvas.getContext('2d');

		tileCanvas = document.createElement("canvas");
		tileCanvas.width = peepholeWidth * 2;
		tileCanvas.height = peepholeHeight * 2;
		tileCanvasCtx = tileCanvas.getContext("2d");

		$peephole.css ( {left: options.x, top: options.y});
		draw();

		// Make the peephole draggable. Redraw on drag
		$peephole.draggable( {
			containment: original,
			drag: function () ) {
				// do the gfx
				createTile();
				fill( tileCanvas, outputCtx );
			}
		});
	}
	
	/**
	 * Create tile (on a temporary canvas) using copies of peephole
	 * @return {canvas}	The tile
	 */
	function createTile () {

		var sx = $peephole.position().left,
				sy = $peephole.position().top,
				w = peepholeWidth,
				h = peepholeHeight,
				ctx = tileCanvasCtx; // Reuse of canvas (for performance optimization)

		// Copy peephole unaffected
		ctx.drawImage(original, sx, sy, w, h, 0, 0, w, h);

		// Mirror horizontal and draw on the right spot
		ctx.scale(-1,1); 
		ctx.drawImage(original, sx, sy, w, h, -2*w, 0, w, h );

		// Flip vertically too (quadrant roght bottom)
		ctx.scale(1,-1);
		ctx.drawImage( original, sx, sy, w, h, -2*w, -2*h, w, h)

		// Flip hor again (for quadrant left bottom)
		ctx.scale(-1,1);	
		ctx.drawImage( original, sx, sy, w, h, 0, -2*h, w, h)
	}	

		
	/**
	 * Fill canvas with tile
	 */
	function fill ( tile, ctx ) {

		outputCtx.rect(0, 0, outputCtx.canvas.width, outputCtx.canvas.height);
		outputCtx.fillStyle = outputCtx.createPattern(tile, "repeat");
		outputCtx.fill();

	}

	/**
	 * export data
	 * @return {ImageData} Resulting graphics
	 */
	function getImageData () {

	}

	return {
		getImageData: getImageData
	}
};


function getTileData ()
{
	// prepare to save canvas server side: set data in form-field	
	// $('#tileData').value = $('#canvas').toDataURL("image/png");
	document.getElementById('tileData').value = document.getElementById('canvas').toDataURL("image/png");

	var pos = $( "#draggable" ).position();
	document.getElementById('coor_x').value = pos.left;
	document.getElementById('coor_y').value = pos.top;
}
