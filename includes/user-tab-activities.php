<?php
include_once('config.php');
include_once('app/projects.php');
include_once('app/users.php');

if($_GET['uid']){
	$user_id = $_GET['uid'];}
else{
	$user_id = $_SESSION['uid'];}
	
$interactions = getInteractions($user_id);
$privacy = getPrivacySettings($user_id);
$option_settings=$privacy['selected_option'];
$limit_settings =$privacy['limit_activity'];


if ($interactions){
	foreach ($interactions as $i){
		$timestamp = $i['created_on'];
		$user = getUserNameById($i['created_by']);
		$author = getUserNameById($i['author']);
		if($i['type'] == 'ideathread'){$title = getIdeaTitle($i['id']); $url =SITE_URL.'/home.php?iid='.$i['id'];}
		if($i['type'] == 'project'){$title = getProjectTitle($i['id']); $url = SITE_URL.'/home.php?pid='.$i['id'];}
		
		if($i['action'] == 'like'){
			$action = 'liked';
			$icon_image = SITE_URL.'/images/icons/like.png';
		}
		if($i['action'] == 'comment'){
			$action = 'commented on';
			$icon_image = SITE_URL.'/images/icons/comment.jpg';
		}
		if($i['action'] == 'rate'){
			$action = 'rated';
			$icon_image = SITE_URL.'/images/icons/star.jpg';
		}
		if($i['action'] == 'route'){
			$action = 'routed';
			$icon_image = SITE_URL.'/images/icons/routeproject.jpg';
		}
		
		?>
			<?php if ($option_settings=='2' && $limit_settings=='4'||$option_settings=='1' && $limit_settings=='4') { ?>
				<?php 	if($_GET['uid']==$_SESSION['uid']) { ?>

				<div style="font-size:15px; margin-bottom:10px;" >
        		<img src="<?php echo $icon_image?>" width="20px">
        		<span class=""><?php echo ucwords($user).' '.$action.' '?><a href="<?php echo SITE_URL;?>/user.php?uid=<?php echo  $i['author'];?>" style="color: #FF0303; text-decoration:none;"><?php echo ucwords($author);?></a><?php echo "'s ". $i['type']?> <a href="<?php echo $url?>" style="color: #FF0303; text-decoration:none;"><?php echo $title;?>.<a></span>
        		<span style="margin-left:10px; font-size:13px;"><?php echo TimeAgo(date('Y-m-d', strtotime($timestamp))); ?> </span>
        		</div>
				<?php
				} else
					{echo "";}
		}?>
		<?php if ($option_settings=='2' && $limit_settings=='1') { ?>
			<div style="font-size:15px; margin-bottom:10px;" >
				<img src="<?php echo $icon_image?>" width="20px">
				<span class=""><?php echo ucwords($user).' '.$action.' '?><a href="<?php echo SITE_URL;?>/user.php?uid=<?php echo  $i['author'];?>" style="color: #FF0303; text-decoration:none;"><?php echo ucwords($author);?></a><?php echo "'s ". $i['type']?> <a href="<?php echo $url?>" style="color: #FF0303; text-decoration:none;"><?php echo $title;?>.<a></span>
				<span style="margin-left:10px; font-size:13px;"><?php echo TimeAgo(date('Y-m-d', strtotime($timestamp))); ?> </span>
			</div>
				<?php }?>
		<?php if ($option_settings=='2' && $limit_settings=='2') { ?>
			<?php 	if($_GET['uid']==$_SESSION['uid']) { ?>
				<div style="font-size:15px; margin-bottom:10px;" >
					<img src="<?php echo $icon_image?>" width="20px">
					<span class=""><?php echo ucwords($user).' '.$action.' '?><a href="<?php echo SITE_URL;?>/user.php?uid=<?php echo  $i['author'];?>" style="color: #FF0303; text-decoration:none;"><?php echo ucwords($author);?></a><?php echo "'s ". $i['type']?> <a href="<?php echo $url?>" style="color: #FF0303; text-decoration:none;"><?php echo $title;?>.<a></span>
					<span style="margin-left:10px; font-size:13px;"><?php echo TimeAgo(date('Y-m-d', strtotime($timestamp))); ?> </span>
				</div>
					<?php }else{

						$router =getRoutersForUser($_GET['uid']);
						if(!empty($router)){ ?>
							<div style="font-size:15px; margin-bottom:10px;" >
					<img src="<?php echo $icon_image?>" width="20px">
					<span class=""><?php echo ucwords($user).' '.$action.' '?><a href="<?php echo SITE_URL;?>/user.php?uid=<?php echo  $i['author'];?>" style="color: #FF0303; text-decoration:none;"><?php echo ucwords($author);?></a><?php echo "'s ". $i['type']?> <a href="<?php echo $url?>" style="color: #FF0303; text-decoration:none;"><?php echo $title;?>.<a></span>
					<span style="margin-left:10px; font-size:13px;"><?php echo TimeAgo(date('Y-m-d', strtotime($timestamp))); ?> </span>
				</div>
					<?php	}


				}

			?>

				<?php }?>



<?php	}
	
	}
?>