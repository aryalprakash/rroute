<?php 

$cure_date = date('Y-m-d', time());
$cur_amount = $user['balance'];
$amounts = array();
for ($i = 0; $i < 30; $i++) {
   $date =  date('Y-m-d', strtotime($cure_date . ' - '.$i.' day'));
   $balance = getAmountForDate($date, $user['user_id']);
   
   if (isset($balance))
       $cur_amount = $balance;
       
       if ($cur_amount == 0)  
           $cur_amount = 3; 
       $amounts[] = 103 - round($cur_amount / 3 );
}

?>

<script>
   window.onload = function() {
	   var canvas = document.getElementById("drawingCanvas");
	   var context = canvas.getContext("2d");   
           
           var canvas1 = document.getElementById("drawingCanvas1");
	   var context1 = canvas1.getContext("2d");   
           
	   var startX = 20;
           var startY = 101;
           var endX = 860; 
           var step = 30;
           
		context.lineWidth = 3;
		context.strokeStyle = "rgb(255,84,0)";                                
                
		context.moveTo(endX, <?php echo $amounts[0]; ?>);
                
		
                <?php 
                for ($i = 0; $i < 29; $i++) {
                  echo 'context.lineTo('.(860 - $i*30).', '.$amounts[$i].');';  
                }
                ?>

		context.stroke();
                
                
             var startX = 20;
           var startY = 101;
           var endX = 860; 
           var step = 30;
           
		context1.lineWidth = 3;
		context1.strokeStyle = "rgb(255,84,0)";                                
                
		context1.moveTo(endX, <?php echo $amounts[0]; ?>);
                
		
                <?php 
                for ($i = 0; $i < 29; $i++) {
                  echo 'context1.lineTo('.(860 - $i*30).', '.$amounts[$i].');';  
                }
                ?>

		context1.stroke();   
                           
                
  }
</script>


<canvas id="drawingCanvas" width="883" height="203"></canvas>
