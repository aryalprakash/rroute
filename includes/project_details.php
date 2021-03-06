<?php
$user = getUserData($project['created_by']);
?>
<div class="content-block">
    <div class="content-left-col project-details">
        <div class="user-photo">
            <?php if (empty($user['photo'])) {
                echo '<a href="user.php?uid=' . $user['user_id'] . '"><img src="uploads/avatars/nophoto.jpg" alt=""></a>';
            } else {
                echo '<a href="user.php?uid=' . $user['user_id'] . '"><img src="uploads/avatars/' . $user['photo'] . '" alt=""></a>';
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
                <li><label>Name:</label><?php echo ucwords($user['display_name']); ?></li>
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
        <?php foreach ($devs as $d) {
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
        <?php } ?>
    </div>
<?php }
?>


<div class="content-block">
    <div class="content-title left-pull"><a style="text-decoration: none" href="<?php echo SITE_URL.'/home.php?pid='.$project['project_id']; ?>"><?php echo $project['project_title']; ?></a></div>
    <div class="project-review-category"><?php echo getProjectCategoryById($project['project_category']); ?> | Rating:
        <b> <?php echo calculateRating($project['project_id']); ?></b></div>
    <br/>

    <div class="project-short-review"
         style="width: 100%; background-color: #183C6E; color: white; margin-top: 50px; min-height: 150px;">
        <div class="one-third left" style="width: 31%; padding: 10px;">
            <div class="project-review-type">
                Category: <?php echo getProjectCategoryById($project['project_category']); ?> </div>
            <hr class="ninty"/>
            <div class="project-review-type">Rating: <?php echo calculateRating($project['project_id']); ?></div>
            <hr class="ninty"/>
            		<div class="project-review-type">Ranking:
            <?php echo $rank = getRankForProject($project['project_id']); ?></div>
        </div>
        <div class="one-third left" style="width: 31%; padding: 10px;">
            <div class="project-review-type">Likes: <?php echo getLikesCount($project['project_id']); ?> </div>
            <hr class="ninty"/>
            <div class="project-review-type">Comments: <?php echo getCommentsCount($project['project_id']); ?></div>
            <hr class="ninty"/>
            <div class="project-review-type">Routes: 2</div>
        </div>
        <div class="one-third left" style="width: 31%; padding: 10px;">
            <div class="project-review-type">Raised Value: 0</div>
            <hr class="ninty" style="width: 82%"/>
            <div class="project-review-type">Asked Value: <?php echo $project['startup_amount']; ?></div>
            <hr class="ninty" style="width: 82%"/>
            <div class="project-review-type">Investors: <?php echo $project['investor_count'];?></div>
        </div>
    </div>


</div>


<div class="content-block">
    <div class="content-title">Featuring Presentation</div>
    <div style="width: 100%">
        <?php
        $video = getFeaturingVideo($id);
        if (!empty($video)) { ?>
            <div class="" style="width: 50%; float: left; text-align-center; margin: 0 auto;">
                <script type="text/javascript" src="js/flowplayer/flowplayer-3.2.4.min.js"></script>
                <link href="js/video-js/video-js.css" rel="stylesheet" type="text/css">
                <!-- video.js must be in the <head> for older IEs to work. -->
                <script src="js/video-js/video.js"></script>

                <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
                <script>
                    videojs.options.flash.swf = "js/video-js/video-js.swf";
                </script>

                <div class="project-video auto-width">
                    <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="420"
                           height="297" data-setup="{}">
                        <source src="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"/>
                        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a
                            web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports
                                HTML5 video</a></p>
                    </video>
                </div>
            </div>
        <?php } ?>

        <?php
        $image = getFeaturingImage($id);
        if (!empty($image)) { ?>
            <div class="" style="margin: 0 auto; width: 50%; float: left; text-align: center;">
                <p><img src="uploads/images/<?php echo $image; ?>" style="width: 100%"></p>
            </div>
        <?php } ?>


        <?php
        $text = getFeaturingText($id);
        if (!empty($text)) { ?>
            <div class="form-item no-height"><p><?php echo $text; ?></p></div>
        <?php } ?>
    </div>
</div>


<div class="content-block">
    <div class="content-title">Project Story</div>
    <p> <?php echo $project['details']; ?>
</div>


<div class="content-block">
    <div class="content-title">Extra Details</div>
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
                <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="420" height="250"
                       data-setup="{}">
                    <source src="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"/>
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web
                        browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5
                            video</a></p>
                </video>

            </div>

        <?php } ?>

        <?php $images = getImages($id);
        if (!empty($images)) {
            ?>
            <div class="project-images" style="float: none; width: initial;">
                <?php foreach ($images as $image)
                    echo '<img src="' . SITE_URL . '/uploads/images/' . $image['file_name'] . '" alt="">';
                ?>
            </div>
        <?php } ?>
    </div>

</div>

<div class="content-block">
    <div class="content-title">Financial Plan</div>
    <div class="form-item no-height"><p>Startup Amount: $<?php echo $project['startup_amount']; ?></p></div>
    <div class="form-item no-height"><p>Rewards: <?php echo $project['reward']; ?></p></div>
    <div class="form-item no-height"><p>Financial Model: <?php echo $project['about_amount']; ?></p></div>
</div>


<div class="content-block">
    <div class="content-title">Risk / Challenges</div>
    <p><?php echo $project['risk_amount']; ?></p>
</div>

<div class="content-block">
    <div class="content-title">List of Investors</div>
    <div class="form-item no-height">
    </div>
</div>
<?php
$rater = getRatertoProject($project['project_id']);
print_r($rater);
if($rater==true){//make true for actual result
    ?>
<div class="content-block">
    <div class="content-title">
        <?php
        $rate = getAdminRatedStatus($project['project_id'], $_SESSION['uid']);
        $value=getAdminRateForProject($project['project_id'], $_SESSION['uid']);
        if($project['seed_rating']==0)
            $seed='N/A';
        else $seed =$project['seed_rating'];
        if ($rate=='1') {
            ?>
            <input type="button" class="buttonclick admin_rate_project_<?php echo $project['project_id']  ?>-rated" id="admin_rate_project"
                   data-id="<?php echo $project['project_id'] ?>" value="Rated" title="<?php echo 'Seed Rating: '.$seed; ?>"style="opacity: 0.6;" disabled />
            <?php
        } else {
            $rate = 0;
            ?>
            <input type="button" href="#" class=" buttonclick admin_rate_project_<?php echo $project['project_id']  ?>" id="admin_rate_project"
                   data-id="<?php echo $project['project_id'] ?>" value="Rate" title="<?php echo 'Seed Rating: '.$seed; ?>"/>
        <?php } ?>

    </div>

</div>

    <div class="admin-rate-area admin-rate-area-<?php echo $project['project_id'] ?>">

        <?php echo substr($project['project_title'],0,30);?> <div class="close-me"> X</div></br>
        <div class="divline"></div>

        <p class="listheight">Feasibility:      <input type="number"min="0" max="10" id="fes_value_<?php echo $project['project_id']; ?>" class="admin_rating_value"value="<?php if($value!=false) echo $value['feasibility']; else echo '';?>" placeholder="0-10"></p>
        <p class="listheight"> Uniqueness:       <input type="number"min="0"step="1"max="10"id="uni_value_<?php echo $project['project_id']; ?>" class="admin_rating_value"value="<?php //if($value!=false) echo $value['uniqness']; else echo '';?>" ></p>
        <p class="listheight"> Growth Quality:   <input type="number"min="0"step="1"max="10" id="gro_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['growth_quality']; else echo '';?>"></p>
        <p class="listheight">  Startup Easeness: <input type="number"min="0"step="1"max="10" id="sta_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php// if($value!=false) echo $value['startup_easeness'];else echo '';?>"></p>
        <p class="listheight">  Process Clarity:  <input type="number"min="0"step="1"max="10" id="pro_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['process_clarity'];else echo '';?>"></p>
        <p class="listheight">   Risk Factor:      <input type="number"min="0"step="1"max="10" id="ris_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php// if($value!=false) echo $value['risk_factor'];else echo '';?>"></p>
        <p class="listheight">   Time consumption: <input type="number"min="0"step="1"max="10" id="tim_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['time_consumption'];else echo '';?>"></p>
        <p class="listheight">  Redundancy:       <input type="number"min="0"step="1"max="10" id="red_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['redundancy_featured'];else echo '';?>"></p>
        <p class="listheight">  Impact:          <input type="number"min="0"step="1"max="10" id="imp_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['impact'];else echo '';?>"></p>
        <p class="listheight">   Profile:           <input type="number"min="0"step="1"max="10" id="prf_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['profile'];else echo '';?>"></p>

        <a href="#" class="project-action-btn" id="admin_save_rate_project"
           data-id="<?php echo $project['project_id'] ?>"
           data-user="<?php echo $_SESSION['uid']; ?> "style="color:#fff">Rate</a>
    </div>
<?php } ?>