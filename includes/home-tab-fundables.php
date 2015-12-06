<?php
include_once('config.php');
include_once('app/projects.php');
include_once('app/users.php');

$projects = getProjectsInTrend();

if ($projects) {

    $added_array = array();

    foreach ($projects as $p) {

        if (in_array($p['project_id'], $added_array))
            continue;

        $added_array[] = $p['project_id'];

        $project = getProjectById($p['project_id']);

        $title = $project['project_title'];
        $startup_amount = $project['startup_amount'];
        $raised_amount = 1500;
        $mark = $raised_amount*100/$startup_amount;
        $color_mark = 100-$mark;
        
        $user = getUserData($project['created_by']);
        
        $reward = $project['reward'];
        $ppc = $project['per_product_cost'];
        $eq_pc = $project['equity_pc'];

        if (strlen($title) < 20)
            $short_title = $title;
        else
            $short_title = substr($title, 0, 19) . '...';
        ?>
        <div> 
        <div class="recent-project-item" style="float: left; margin:inherit">

            <?php $image = getFeaturingImage($project['project_id']);
            if (!empty($image)) {
                ?>
                <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/images/thumbs/' . $image; ?>" alt=""></a>
        <?php } else { ?>
                <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/avatars/nophoto.jpg'; ?>" alt=""></a>
        <?php } ?>

            <div class="project-bottom-details">
            <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><?php echo $short_title; ?></a>
            <span class="project-rating"><?php echo calculateRating($project['project_id']); ?></span>
            
            </div> <!-- project-bottom-details --> 
            
            <div class="project-author"><?php echo TimeAgo(date('Y-m-d', strtotime($project['created_on']))); ?> by <a href="user.php?uid=<?php echo $project['created_by']; ?>"><?php echo $user['display_name']; ?></a></div>
            
            
        </div>
        <div class="inside-tab-right" style="margin-left: 210px;">
        	<div class="top-part">
        		<div class="half-left">
        			<div class="title-colored">Raised: $ <?php echo $raised_amount;?></div>
        			<div id="slider-range-value" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="height: 1px;"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-max" style="width: <?php echo $color_mark;?>%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" style="border: 0; background: #FF4F00;    border-radius: 50%;    left: <?php echo $mark;?>%;    height: 0.4em;    width: 0.4em;    margin-left: 0;    top: -0.2em;" tabindex="0" style="left: <?php echo $mark;?>%;"></span></div>
        			<div class="title-colored">Asked: $ <?php echo $startup_amount; ?></div>
        		</div>
        		<div class="half-right">
        			<div class="title-colored" style="text-align: right; margin-bottom: 20px;">Total Investors: 5</div>
        			
        			<div class="title-colored" style="text-align: left">Reward: <?php echo $reward; ?></div>
        		</div>
        	</div>
        	<div class="bottom-part" id="pid<?php echo $project['project_id']; ?>" style="">
        		<div style="width: 100%; height: 50px;"><div class="highlight">32 days remaining <button id="<?php echo $project['project_id']; ?>" class="button-colored"  style="text-align: right; margin-left: 15px;" onclick="showBox(this, '<?php echo $startup_amount ?>', '<?php echo $reward ?>', '<?php echo $ppc ?>', '<?php echo $eq_pc ?>');">Fund it</button></div></div>
        		<div class="funding" style="display: none; width: 100%;">
        		<div class="half-left center">
        			Enter the investment amount<br/><br/>
        			$ &nbsp; <input type="number" id="investment_amount" style="padding: 5px;">
        		</div>
        		<div class="half-right center" style="padding-right: 15px;">
        			Select the reward<br/><br/>
        			<div class="form-item thematic-box" style="padding: 10px 5px;">
        				<form>
        				<?php if($reward == 'Equity'){ ?>
        				<div class="thematic-items" style="width: 97%;">
        					<span class="my_equity"></span>% of <?php echo $eq_pc; ?>% reward<br/>
        					<!--<input type="radio" name="reward">-->
        				</div>
        				<?php } 
        				if ($reward == "Product"){?>
        				<div class="thematic-items" style="width: 50%;">
        					Final Product<br/>
        					<input type="radio" name="reward" id="product" disabled>
        				</div>
        				<div class="thematic-items" style="width: 50%;">
        					Users Choice<br/>
        					<input type="radio" name="reward" id="product-reward" disabled>
        				</div>
        				<?php } ?>
        				</form>
        				
        			</div>
        			<button class="button-colored finalize" style="float: right; margin-top: 10px;" disabled >Finalize</button>
        		</div>
        		</div>
        	</div>
        
        </div>
        </div>
        <hr/>
        
        
    <?php
    }
}
?>

<script type="text/javascript" src="https://www.rangeenroute.com/js/main.js"></script>
        <script type="text/javascript" src="https://www.rangeenroute.com/js/newScripts.js"></script>
        <script>
        
        var divId;
        var showBox = function(el, startup_amount, reward_type, per_product_cost, equity_pc){
        
        
	    	var divId = '#pid'+el.id;
	    	$(divId).children('.funding').slideDown('slow');
	    	
	    	//var startup_amount = <?php echo $startup_amount; ?>;
	    	//var per_product_cost = <?php echo $ppc ?>;
	    	//var equity_pc = <?php echo $eq_pc ?>;
	    	//var reward_type = <?php echo $reward ?>;
	    	
	    
	    	
    		$(divId).children('.funding').children('.half-right').children('.thematic-box').children('form').children('.thematic-items').children('input[name=reward]').attr("disabled",true);
    		
    		
       
        	$(divId).children('.funding').children('.half-left').children('#investment_amount').keyup(function(){
        	
        			var input_amount = $(divId).children('.funding').children('.half-left').children('#investment_amount').val();
        			
	       
	        	$(divId).children('.funding').children('.half-right').children('.thematic-box').children('form').children('.thematic-items').children('input[name=reward]').removeAttr("checked");
	        	
	        	if(reward_type == "Product" && input_amount >0 ){
	        	
	        	
	        	
		        	if(parseInt(input_amount) > per_product_cost ){
		        	
		        	
		        	
		        	$(divId).children('.funding').children('.half-right').children('.thematic-box').children('form').children('.thematic-items').children('input[name=reward]').attr("disabled",false);
		        	
		        	}
		        	
		        	else{
		        	
		        	$(divId).children('.funding').children('.half-right').children('.thematic-box').children('form').children('.thematic-items').children('input[name=reward]').attr("disabled",true);
		        	
		        	$(divId).children('.funding').children('.half-right').children('.thematic-box').children('form').children('.thematic-items').children('#product').attr("disabled",false);
		        	
	        		}
	        		
	        		$(divId).children('.funding').children('.half-right').children('.finalize').attr("disabled",false);
	        		
        		}
        		
        		
        		else if(reward_type == "Equity" && input_amount >0){
        			
        			var my_equity = input_amount*100/startup_amount;
        			
        			$('.my_equity').html(my_equity);
        			
        			$(divId).children('.funding').children('.half-right').children('.finalize').attr("disabled",false);
        			
        			
        			
        		}
        		
        		else{
        		
        			$(divId).children('.funding').children('.half-right').children('.thematic-box').children('form').children('.thematic-items').children('input[name=reward]').attr("disabled",true);
        			$('.my_equity').html('');
        		
        		}
        
        });
        
        
    		
    	}	
        
        
        </script>