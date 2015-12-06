<?php
include_once('config.php');
include_once('app/users.php');
include_once('app/projects.php');

if (empty($_GET['uid']))
    $user_id = $_SESSION['uid'];
else
    $user_id = intval($_GET['uid']);

$ideas = getIdeas($user_id);


if ($ideas) {
	
     foreach ($ideas as $idea) {
     	
    	
	$title = $idea['ideathread_title'];
	$description = $idea['description'];
	$time = TimeAgo(date('Y-m-d', strtotime($idea['created_on'])));
	$ideathread_id = $idea['ideathread_id'];
	$status = $idea['status'];
	$source = $idea['source_url'];
	
	$source_details = parse_url($source);
			if($source_details[host] == 'rangeenroute.com' || $source_details[host] == 'www.rangeenroute.com'){
				if($source_details[path] == '/home.php' ){
					parse_str($source_details[query], $output);
					
					if($output['pid']){
						$project_exists = true;
						list($url, $project_id) = explode("=", $source);
						
					}
				} 	
			}
	
	if($idea['thumbnail_img']){
	$thumbnail=$idea['thumbnail_img'];
	}else{
	$thumbnail = 'uploads/avatars/nophoto.jpg';
	}
	
	$author = $idea['original_creator'];
	$userId = $idea['created_by'];
	$user = getUserData($idea['created_by']);
	$name = $user['display_name'];
	
	if($user['photo']){
	$userphoto = $user['photo'];
	}else{
	$userphoto = 'nophoto.jpg';
	}
	
	$likes = getIdeaLikes($ideathread_id);
	$comments = countIdeaComments($ideathread_id);
	
        

        if (strlen($title) < 20)
            $short_title = $title;
        else
            $short_title = substr($title, 0, 19) . '...';
            
        ?>
        <div class="user-list-idea idea_<?php echo $ideathread_id ?>">
        	
        	
        	<div class="idea-action">
        	
        	<?php
        	
        	
	        	if ($status == 'notapproved'){
	        	echo '<div class="idea-status"><img src="/images/icons/pending.jpg" width="100%" title="Pending"></div>';
	        	}
	        	else if ($status == 'approved'){
	        	echo '<div class="idea-status"><img src="/images/icons/approved.jpg" width="100%" title="Approved"></div>';
	        	}
	        	else{
	        	echo '<div class="idea-status"><img src="/images/icons/rejected.jpg" width="100%" title="Denied"></div>';
	        	}
        		if($idea['created_by'] == $_SESSION['uid']){ 
        		?>
        		<div class="delete-idea" id="delete-idea" data-id="<?php echo $ideathread_id ?>" onclick="deleteIdea('<?php echo $ideathread_id; ?>');"><img src="/images/icons/delete.jpg" width="100%" title="Delete"></div>
        	<?php } ?>
        	</div>
        	<div class="thumb-img" style="float: left">
        		
        		<a href="<?php echo $source ?>" target="_blank"><img src="<?php echo $thumbnail ?>" height="100%" width="100%"></a>
        		
        		
        	</div>
        	<div class="idea-preview" >
        		<div class="seventy left" style="margin-bottom: -15px; width: 77%;">
        			<a href="<?php echo '/home.php?iid='.$ideathread_id ?>" style="text-decoration: none;"><h1 class="idea-title"><?php echo $title; ?></h1></a>
        			<span class="hueued"><?php echo $time ?></span> &nbsp; &nbsp;<span class="hueued"></span>
        			<p class="idea-description"><?php echo $description; ?></p>
        		</div>
        		<div class="thirty right" style="width: 23%;">
	        		<div style="width: 50%; float: left">
	        			<div class="idea-stats"><a href="<?php echo '/home.php?iid='.$ideathread_id ?>"><img src="/images/icons/star.jpg" /></a><div class="stat-no"><?php if($project_exists){echo calculateRating($project_id);}?></div></div>
	        			<div class="idea-stats"><a href="<?php echo '/home.php?iid='.$ideathread_id ?>"><img src="/images/icons/ranking.png" /></a><div class="stat-no"><?php if($project_exists){echo getRankForProject($project_id);}?></div></div>
	        			<div class="idea-stats"><a href="<?php echo '/home.php?iid='.$ideathread_id ?>"><img src="/images/icons/like.png" /></a><div class="stat-no"><?php echo $likes ?></div></div>
	        			<div class="idea-stats"><a href="<?php echo '/home.php?iid='.$ideathread_id ?>"><img src="/images/icons/comment.jpg"/></a><div class="stat-no"><?php echo $comments ?></div></div> 
        			</div>
        			<div style="width: 50%; float: right">
        				<div class="thumb" style="float: right"><a href="/user.php?uid=<?php echo $userId ?>"><img src="uploads/avatars/thumbs/<?php echo $userphoto ?>" title="Posted by <?php echo $name ?>"></a></div>
        				<div class="thumb" style="float: right"><img src="/uploads/avatars/nophoto.jpg" title="Created by <?php echo $author ?>"></div>
        			</div>
        		</div>
        		
        	</div>
        </div>
        <div class="index line" style="width: 100%; float: left;"></div>
        
     
<?php 
}
            
   
}
?>

<script type="text/javascript">
     
  </script>