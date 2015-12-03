<script>
   window.onload = function() {
	   var canvas = document.getElementById("drawingCanvas");
	   var context = canvas.getContext("2d");
	   
		context.lineWidth = 3;
		context.strokeStyle = "rgb(255,84,0)";

		context.moveTo(20, 101);

		var controlX_1 = 250;
		var controlY_1 = 0;
		var controlX_2 = 400;
		var controlY_2 = 200;
		var endPointX = 883;
		var endPointY = 0;

		context.bezierCurveTo(controlX_1, controlY_1, controlX_2, controlY_2,
                    endPointX, endPointY);
		context.stroke();
  }
</script>


<canvas id="drawingCanvas" width="883" height="203"></canvas>