<?php
include_once('config.php');
include_once('app/users.php');
include_once('app/projects.php');

//if (empty($_GET['uid']))
//    $user_id = $_SESSION['uid'];
//else
//    $user_id = intval($_GET['uid']);
if (empty($_SESSION['logged_in']))
	redirect('index.php');

if (isset($_GET['uid']))
	$user_id = intval($_GET['uid']);
else
	$user_id = $_SESSION['uid'];


$ideas = getIdeas('all');


if ($ideas) {
     foreach ($ideas as $idea) {
	$title = $idea['ideathread_title'];
	$description = $idea['description'];
	$time = TimeAgo(date('Y-m-d', strtotime($idea['created_on'])));
	$ideathread_id = $idea['ideathread_id'];
	$status = $idea['status'];
	$source= $idea['source_url'];
	global $project_exists;
	$source_details = parse_url($source);
			if($source_details['host'] == 'rangeenroute.com' || $source_details['host'] == 'www.rangeenroute.com'){
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
	$thumbnail = SITE_URL.'/uploads/avatars/nophoto.jpg';
	}

	$author = $idea['original_creator'];
	$user = getUserData($idea['created_by']);
	$name = $user['display_name'];
	$nophoto =SITE_URL.'/uploads/avatars/nophoto.jpg';
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
        <div class="user-list-idea">



        	<div class="thumb-img" style="float: left">

        		<a href="<?php echo $source ?>" target="_blank"><img src="<?php if(!empty($thumbnail)) echo $thumbnail;else echo $nophoto; ?>" height="100%" width="100%"></a>


        	</div>
        	<div class="idea-preview" >
        		<div class="seventy left" style="margin-bottom: -15px;">
        			<a href="<?php echo SITE_URL.'/home.php?iid='.$ideathread_id ?>" style="text-decoration: none;"><h1 class="idea-title"><?php echo $title; ?></h1></a>
        			<span class="hueued"><?php echo $time ?></span> &nbsp; &nbsp;<span class="hueued"></span>
        			<p class="idea-description"><?php echo $description; ?></p>
        		</div>
        		<div class="thirty right" style="">
	        		<div style="width: 50%; float: left">
	        			<div class="idea-stats"><a href="<?php echo SITE_URL.'/home.php?iid='.$ideathread_id ?>"><img src="./images/icons/star.jpg" /></a><div class="stat-no"><?php if($project_exists){echo calculateRating($project_id);}?></div></div>
	        			<div class="idea-stats"><a href="<?php echo SITE_URL.'/home.php?iid='.$ideathread_id ?>"><img src="./images/icons/ranking.png" /></a><div class="stat-no"><?php if($project_exists){echo getRankForProject($project_id);}?></div></div>
	        			<div class="idea-stats"><a href="<?php echo SITE_URL.'/home.php?iid='.$ideathread_id ?>"><img src="./images/icons/like.png" /></a><div class="stat-no"><?php echo $likes ?></div></div>
	        			<div class="idea-stats"><a href="<?php echo SITE_URL.'/home.php?iid='.$ideathread_id ?>"><img src="./images/icons/comment.jpg"/></a><div class="stat-no"><?php echo $comments ?></div></div>
        			</div>
        			<div style=" float: right">

        				<div class="thumb"><a href="<?php echo SITE_URL.'/user.php?pid='.$idea['created_by']; ?>">
								<img src="./uploads/avatars/thumbs/<?php echo $userphoto; ?>" title="Posted by <?php echo $name ?>"></a></div>
        				<div class="thumb"><img src="./uploads/avatars/nophoto.jpg" title="Created by <?php echo $author ?>"></div>
        			</div>
        		</div>

        	</div>
        </div>
        <div class="index line" style="width: 100%; float: left;"></div>

     <script type="text/javascript">
      function ConfirmDelete()
      {
            if (confirm("Are you sure you want to delete this?"))
                 <?php echo'done'; ?>
      }
  </script>
<?php
}


}
?>