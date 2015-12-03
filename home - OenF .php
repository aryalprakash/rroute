<?php
include ('includes/header.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');
?>

<div class="inner-page-wrapper">

    <div class="account inner-page user-home-page content">

        <?php include (DIR_INCLUDE . 'left_nav_home.php'); ?>


        <div class="main-content home">
            <div class="profile-home-add">
                <form action="upload.php" method="post">
                    <input type="radio" name="type_project[]" id="add_project_radio" checked value="project"> <label for="add_project_radio">Project</label>
                    <input type="submit" name="add_project" value="Upload">
                </form>
            </div>

            <div class="content-block right-home-border">
                <?php
                if (!isset($_GET['pid'])) {
                    $project = getLastActiveProject();
                    $user = getUserData($_SESSION['uid']);
                } else {
                    $project = getProjectById(intval($_GET['pid']));
                    $user = getUserData($project['created_by']);
                }
                if (empty($project))
                    echo '<div class="content-title">There is no project of yours posted.</div>';
                else {
                    ?>
                    <div class="content-title">
                        <div class="router-user-photo">
                            <a href="user.php?uid=<?php echo $user['user_id']; ?>">
                                <?php if (empty($user['photo'])) { ?>
                                    <img src="uploads/avatars/nophoto.jpg" alt="">
                                <?php } else {
                                    ?>
                                    <img src="uploads/avatars/thumbs/<?php echo $user['photo']; ?>" alt="">
                                <?php } ?>
                            </a>
                            <div class="router-user-name">
                                <a href="user.php?uid=<?php echo $user['user_id']; ?>" ><?php echo $user['first_name'] . '<br>' . $user['last_name']; ?></a>
                            </div>
                        </div>
                        <a href="project_details.php?pid=<?php echo $project['project_id']; ?>" class="project-title"><?php echo $project['project_title']; ?></a></div>

                    <?php
                    $featuring = getFeaturingItem($project['project_id']);

//print_r($featuring);

                    if (!$featuring) {

                        $text = getFeaturingText($project['project_id']);
                        if (!empty($text)) {
                            ?>
                            <div class="form-item no-height"><p><?php echo $text; ?></p></div>

                            <?php
                        }
                    } else {
                        if ($featuring['featuring_type'] == 'picture') {
                            $image = getFeaturingImage($project['project_id']);
                            if (!empty($image)) {
                                ?>
                                <p><img src="uploads/images/<?php echo $image; ?>"></p>
                                <?php
                            }
                        } else {
                            $video = getVideo($project['project_id']);
                            ?>
                            
                             <!-- Chang URLs to wherever Video.js files will be hosted -->
  <link href="js/video-js/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="js/video-js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    videojs.options.flash.swf = "js/video-js/video-js.swf";
  </script>
                               
  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" data-setup="{}">
    <source src="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"/>    
    <track kind="captions" src="js/video-js/demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
    <track kind="subtitles" src="js/video-js/demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>
                            <script type="text/javascript" src="js/flowplayer/flowplayer-3.2.4.min.js"></script>
                            <div class="project-video auto-width">
                                <a href="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"  style="display:block;width:598px; height: 400px;"  id="player1"> </a>
                                <script>
                                    flowplayer("player1", "js/flowplayer/flowplayer-3.2.5.swf",
                                            {
                                                clip: {
                                                    // these two configuration variables does the trick
                                                    autoPlay: false,
                                                    autoBuffering: true // <- do not place a comma here
                                                }
                                            });
                                </script>
                            </div>
                            <?php
                        }

                        $text = getFeaturingText($project['project_id']);
                        if (!empty($text)) {
                            ?>
                            <div class="form-item no-height"><p><?php echo $text; ?></p></div>
                            <?php
                        }
                    }
                    
                    
                    $rank = getRankForProject($project['project_id']);
                    ?>

                    <div class="home-project-info">
                        <p>Rating: <span><?php echo calculateRating($project['project_id']); ?></span></p>
                        <p>Ranking: <span><?php echo $rank; ?></span></p>
                        <p>Analysis: <span><a href="project_details.php?pid=<?php echo $project['project_id']; ?>"><img src="images/icons/stat.png"></a></span></p>
                    </div>

                    <div class="project-action">
                        <?php
                        $rate = getUserRateForProject($project['project_id'], $_SESSION['uid']);
                        if ($rate) {
                            ?>
                            <a href="#" class="project-action-btn inactive" id="rate_project" data-id="<?php echo $project['project_id'] ?>">Rated</a>
                            <?php
                        } else {
                            $rate = 0;
                            ?>
                            <a href="#" class="project-action-btn" id="rate_project" data-id="<?php echo $project['project_id'] ?>">Rate</a>
                        <?php } ?>

                        <?php if (checkRoutedProject($project['project_id'], $_SESSION['uid'])) { ?>
                            <a href="#" class="project-action-btn" id="routed_project" data-id="<?php echo $project['project_id'] ?>" title="Unroute">Routed</a>
                            <a href="#" class="project-action-btn" id="route_project" data-id="<?php echo $project['project_id'] ?>" style="display: none;">Route</a>
                        <?php } else { ?>
                            <a href="#" class="project-action-btn" id="routed_project" data-id="<?php echo $project['project_id'] ?>"  style="display: none;" title="Unroute">Routed</a>
                            <a href="#" class="project-action-btn" id="route_project" data-id="<?php echo $project['project_id'] ?>">Route</a>
                        <?php } ?>

                        <a href="#" class="project-action-btn" id="comment_project" data-id="<?php echo $project['project_id'] ?>">Comment</a>

                        <?php if (checkLikedProject($project['project_id'], $_SESSION['uid'])) { ?>
                            <a href="#" class="project-action-btn" id="liked_project" data-id="<?php echo $project['project_id'] ?>" title="Unlike">Liked</a>
                            <a href="#" class="project-action-btn" id="like_project" data-id="<?php echo $project['project_id'] ?>" style="display: none;">Like</a>
                        <?php } else { ?>
                            <a href="#" class="project-action-btn" id="liked_project" data-id="<?php echo $project['project_id'] ?>" style="display: none;">Liked</a>
                            <a href="#" class="project-action-btn" id="like_project" data-id="<?php echo $project['project_id'] ?>">Like</a>
                        <?php } ?>
                        <a href="#" class="project-action-btn" id="report_project" data-id="<?php echo $project['project_id'] ?>">Report</a>
                    </div>

                    <!-- rate -->
                    <div class="rate-area">
                        <script>
                            $(function () {
                                $("#slider-range").slider({
                                    range: "max",
                                    min: 0,
                                    max: 10,
                                    value: <?php echo $rate; ?>,
                                    step: 0.01,
                                    slide: function (event, ui) {
                                        $("#rating_value").val(ui.value);
                                    }
                                });
                                $("#rating_value").val($("#slider-range").slider("value"));
                            });
                        </script>
                        <input type="text" name="rating_value" id="rating_value">
                        <div class="slider-area"><span class="rate-range">0</span> <div id="slider-range"></div> <span class="rate-range">10</span>
                            <a href="#" class="project-action-btn" id="save_rate_project" data-id="<?php echo $project['project_id'] ?>" data-user="<?php echo $_SESSION['uid']; ?>">Submit</a>
                        </div>
                    </div>   <!-- rate area -->

                    <div class="comment-area">
                        <form action="" id="comment-form">
                            <div class="form-item no-height"><textarea class="comment-textarea" data-id="<?php echo $project['project_id']; ?>"></textarea></div>
                            <!--<div class="form-item"><input type="submit" value="Add" class="project-action-btn" id="add-comment-btn" data-id="<?php echo $project['project_id']; ?>"></div>-->
                        </form>

                        <div class="inbox-messages">
                            <?php
                            $messages = getComments($project['project_id']);
                            if ($messages) {

                                foreach ($messages as $ix => $m) {
                                    ?>
                                    <div class="message-item <?php if (($ix % 2) == 0) echo 'odd'; ?>" data-id="<?php echo $ix; ?>">
                                        <div class="message-author">
                                            <?php $u = getUserData($m['created_by']); ?>
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
                                                    <a href="user.php?uid=<?php echo $u['user_id']; ?>"><?php echo $u['first_name'] . '<br>' . $u['last_name']; ?></a>
                                                </div>
                                            </div>

                                            <div class="comment-date"><?php echo $m['created_on'] ?></div>

                                        </div>
                                        <div class="message-content" data-id="<?php echo $ix; ?>"><?php echo $m['text']; ?></div>

                                        <?php if ($m['created_by'] == $_SESSION['uid']) { ?>
                                            <div class="delete delete_<?php echo $m['comment_id']; ?>" data-id="<?php echo $m['comment_id']; ?>" onclick="deleteComment('<?php echo $m['comment_id']; ?>')"></div>
                                        <?php } ?>

                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                    </div>

                    <!-- likes area -->
                    <div class="likes-area">
                    </div>


                    <!-- route -->
                    <div class="route-area">
                        <input type="text" id="searchInput" placeholder="Type To Filter">
                        <div class="routers-set">
                            <?php $routers = getRoutersForUser($_SESSION['uid'], ''); 
                            if ($routers) {
                            ?>
                            
                            <table>                           
                                <tbody id="fbody">
                                    <?php foreach ($routers as $router) {                                         
                                        $u = getUserData($router['user_id']);                                       
                                        ?>
                                    <tr>
                                        <td><input type="checkbox" class="router-item" data-id="<?php echo $u['user_id']; ?>" id="router_<?php echo $u['user_id']; ?>" data-project="<?php echo $project['project_id']; ?>" <?php if (checkSuggestion($project['project_id'], $u['user_id'], $_SESSION['uid'])) echo 'checked'; ?>></td>
                                        <td><label for="router_<?php echo $u['user_id']; ?>"><?php echo $u['first_name'].' '.$u['last_name']?></label></td>
                                    </tr>
                                    <?php } ?>                                    
                                </tbody>
                            </table>
                            <?php } ?>
                        </div> <!-- routers-set -->
                    </div> <!-- route-area -->


                    <!-- report area -->
                    <div class="report-area">
                        <div class="form-item">This project has issue related to:</div>
                        <div class="form-item"><input type="checkbox" id="copyright_issue"> <label for="copyright_issue">Copyright/Privacy/Legal infringement</label></div>
                        <div class="form-item"><input type="checkbox" id="spam_issue"> <label for="spam_issue">Spam/Deceptive</label></div>
                        <div class="form-item"><input type="checkbox" id="violent_issue"> <label for="violent_issue">Violent</label></div>
                        <div class="form-item"><input type="checkbox" id="abusive_issue"> <label for="abusive_issue">Abusive</label></div>
                        <div class="form-item"><input type="checkbox" id="impersonation_issue"> <label for="impersonation_issue">Impersonation</label></div>
                        <div class="form-item"><input type="checkbox" id="harassment_issue"> <label for="harassment_issue">Harassment</label></div>
                        <div class="form-item report-message">Your report has been sent</div>
                        <div class="form-item"><input type="submit" value="Submit" class="project-action-btn" id="report-issue" data-id="<?php echo $project['project_id']; ?>"></div>
                    </div>


                <?php } ?>
            </div>

            <div id="home-tabs">
                <ul>
                    <li><a href="includes/home-tab-recent.php">Recent</a></li>
                    <li><a href="includes/home-tab-routed.php">Routed</a></li>
                    <li><a href="includes/home-tab-trend.php">Trend</a></li>
                    <li><a href="includes/home-tab-activity.php">My Activity</a></li>
                    <li><a href="includes/home-tab-suggestions.php">Suggestions</a></li>
                </ul>
            </div>  <!-- home-tabs -->

        </div>


    </div> <!-- account inner-page content -->

    <?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>