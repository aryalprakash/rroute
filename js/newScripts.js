$(document).ready(function () {
$("#rewardType" )
  .change(function () {
    var str = "";
    $( "#rewardType option:selected" ).each(function() {
      str += $( this ).text();
    });
    
    if(str == 'Product'){
    	$("#equityEntry").slideUp('slow');
    	$("#productEntry").slideDown('slow');
    }
    if(str == 'Equity'){
    	$("#contdProduct").slideUp('slow');
    	$("#productEntry").slideUp('slow');
    	$("#equityEntry").slideDown('slow');
    }
    
  });
  
  var rewardType = $( "#rewardType option:selected" ).text();
  if(rewardType == 'Product'){
    	$("#equityEntry").slideUp('slow');
    	$("#productEntry").slideDown('slow');
    }
    if(rewardType == 'Equity'){
    	$("#contdProduct").slideUp('slow');
    	$("#productEntry").slideUp('slow');
    	$("#equityEntry").slideDown('slow');
    }
    
  
  
  
  $("#projectType" )
  .change(function () {
    var str = "";
    $( "#projectType option:selected" ).each(function() {
      str += $( this ).text();
    });
    
    if(str == 'Monetised'){
    $("#monitizeBar").slideDown('slow');
    }
    else{
    $("#monitizeBar").slideUp('slow');
    }
    
  });
  
   var projectType = $( "#projectType option:selected" ).text();
    
   if(projectType == 'Monetised'){
    $("#monitizeBar").slideDown('slow');
    }
    else{
    $("#monitizeBar").slideUp('slow');
    }
  
  
  
  $("#productSubmit").click(function(){
  	$("#contdProduct").slideDown('slow');
  	return false;
  
  });
  
  
  $("#equitySubmit").click(function(){
  	$("#contdEquity").slideDown('slow');
  	var equity = $("#equityValue").val();
  	var startup_amount = $("#startup_amount").val();
  	$(".equityVal").html(equity + "% Equity Reward for $"+startup_amount);
  });
  
  
  
    //Fundables
    
    var showBox = function(el){
    console.log(el);
    }
    
    $('.help_title').click(function(){
    	contentId = '#'+this.id+'Content';
    	if($(contentId).is( ":hidden" )){
    	$('.help_content').hide();
    	$(contentId).slideDown('slow');
    	}else{
    	$(contentId).hide();
    	}
    	return false;
    });
    
    $(".view-more").click(function() {
    $('html, body').animate({
        scrollTop: $(".signup-line").offset().top
    }, 'slow');
});

$('.allNotifications').click(function(){
	var user_id = $(this).attr('user-id');
	console.log(user_id);
	$.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {user_id: user_id, dispatcher: 'read-notifications'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    console.log(data);
                    $('.notifyNo').css('display','none');
                }
            },
            dataType: "json"
        });
        return false; 
});
    
    
    
});