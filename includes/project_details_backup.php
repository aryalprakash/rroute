<?php
$user = getUserData($project['created_by']);
 ?>
<div class="content-block">
<div class="content-left-col project-details">
<div class="user-photo">
<?php if (empty($user['photo'])) {
echo '<a href="user.php?uid='.$user['user_id'].'"><img src="uploads/avatars/nophoto.jpg" alt=""></a>';
 }
 else {
 	echo '<a href="user.php?uid='.$user['user_id'].'"><img src="uploads/avatars/'.$user['photo'].'" alt=""></a>';
 	}
?>
<div class="name-block"><?php echo $user['display_name']; ?></div>
</div>
</div>

<div class="content-right-col project-details">
<?php
//$user = getUserData($project['created_by']);
//print_r($user);
?>

<div class="form-item no-height">
<ul class="user-info-left">
<li><label>Name:</label><?php echo $user['display_name'] ?></li>
<li><label>Current City:</label><?php echo $user['location'] ?></li>
</ul>

<ul class="user-info-right">
<li><label>Hometown:</label><?php echo $user['location'] ?></li>
<li><label>Education:</label><?php echo $user['high_school'] ?></li>
</ul>
</div>

<p><?php echo $user['about_me']; ?></p>
</div>
</div>



<?php $developers = getDevelopers(intval($project['project_id'])); 
    if ($developers) { 
        $devs = explode(',', $developers['developers']);
        ?>
     <div class="content-block">
        <div class="content-title">Co-founder(s)</div>
        <?php foreach($devs as $d) { 
            $u = getUserData($d);
            ?>
            <div class="router-user-photo">
                                    <a href="user.php?uid=<?php echo $u['user_id']; ?>">
                                        <?php if (empty($u['photo'])) { ?>
                                            <img src="uploads/avatars/nophoto.jpg" alt="">
                                        <?php } else {
                                            ?>
                                            <img src="uploads/avatars/<?php echo $u['photo']; ?>" alt="">
                                        <?php } ?>
                                    </a>
                                    <div class="router-user-name">
                                        <a href="user.php?uid=<?php echo $u['user_id']; ?>"><?php echo $u['display_name']; ?></a>
                                    </div>
                                </div>
        <?php }?>
     </div>   
    <?php }
?>




<div class="content-block">
<div class="content-title left-pull"><?php echo $project['project_title']; ?></div>
<div class="project-review-category"><?php echo getProjectCategoryById($project['project_category']); ?> | Rating: <b>0</b></div>
<div class="form-item no-height"><p><?php echo $project['details']; ?></p></div>
</div>

<?php
$video = getFeaturingVideo($id);
if (!empty($video)) { ?>
<script type="text/javascript" src="js/flowplayer/flowplayer-3.2.4.min.js"></script>

<div class="content-block"><div class="content-title">Featuring Video</div>

<link href="js/video-js/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="js/video-js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    videojs.options.flash.swf = "js/video-js/video-js.swf";
  </script>
        
  <div class="project-video auto-width">
  <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="600" height="338" data-setup="{}">
    <source src="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"/>        
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>                            
      
  </div>  

</div>

<?php } ?>

<?php
$image = getFeaturingImage($id);
if (!empty($image)) { ?>
<div class="content-block featured-image"><div class="content-title">Featuring Picture</div>
<p><img src="uploads/images/<?php echo $image; ?>"></p>
</div>
<?php } ?>

<?php
$text = getFeaturingText($id);
if (!empty($text)) { ?>
<div class="content-block"><div class="content-title">Featuring Text</div>
<div class="form-item no-height"><p><?php echo $text; ?></p></div>
</div>
<?php } ?>


<div class="content-block"><div class="content-title">Startup Amount</div>
<div class="form-item no-height"><p>$<?php echo $project[startup_amount]; ?></p></div>
</div>

<div class="content-block"><div class="content-title">Project Details</div>
<div class="form-item no-height">
<?php $video = getVideo($id);
if (!empty($video)) { ?>

    <link href="js/video-js/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="js/video-js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    videojs.options.flash.swf = "js/video-js/video-js.swf";
  </script>
        
  <div class="project-video auto-width">
  <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="360" height="203" data-setup="{}">
    <source src="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"/>        
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>                            
      
  </div> 

<?php } ?>

<?php $images = getImages($id);
if (!empty($images)) {
?>
<div class="project-images">
<?php foreach ($images as $image)
echo '<img src="'.SITE_URL.'/uploads/images/'.$image['file_name'].'" alt="">';
?>
</div>
<?php } ?>
</div>
<p><?php echo $project['about_amount']; ?></p>
</div>

<div class="content-block"><div class="content-title">Risk / Challenges</div>
<p><?php echo $project['risk_amount']; ?></p>
</div>

<div class="content-block"><div class="content-title">Analytical Data</div>
<div class="form-item no-height">
<ul class="analitics-info-left">
<li><label>Rating:</label><?php echo calculateRating($project['project_id']); ?></li>
<li><label>Ranking:</label><?php echo $rank = getRankForProject($project['project_id']); ?></li>
</ul>

<ul class="analitics-info-right">
<li><label>Likes:</label><?php echo getLikesCount($project['project_id']); ?></li>
<li><label>Comments:</label><?php echo getCommentsCount($project['project_id']); ?></li>
</ul>
</div>
</div>