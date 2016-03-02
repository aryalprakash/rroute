<?php
include('includes/header.php');
include('includes/ChromePhp.php');

//if (empty($_SESSION['logged_in']))
//    redirect('index.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');
?>

<div class="inner-page-wrapper">

    <div class="account inner-page user-home-page content">

        <div class="main-content home view">
            <div class="profile-home-add">

                <form name="project-action" method="post">
                    <input type="radio" name="type_project[]" id="add_project_radio" value="project"> <label
                        for="add_project_radio">Project</label>
                    <input type="radio" style="margin-left:15%" name="type_project[]" id="add_ideaThread_radio"
                           value="ideaThread"> <label for="add_ideaThread_radio">IdeaThread</label>
                    <input type="submit" class="disabled" name="add_project" value="Upload">
                </form>

            </div>

            <div class="content-block right-home-border">

                <?php global $showProject;
                if (isset($_GET['pid'])) {

                    $project = getProjectById($_GET['pid']);
                    $user = getUserData($project['created_by']);
                    if (!empty($project)) {
                        $showProject = true;
                    }
                }

                if (isset($_GET['pid']) && empty($project)) {
                    echo '<div class="content-title">Invalid URL</div>';
                    $showProject = false;
                }

                if (isset($_GET['iid'])) {
                    include 'includes/idea_details.php';
                }

                if ($showProject) {

                    ?>
                    <div class="content-title">
                        <div class="router-user-photo">
                            <a href="user.php?uid=<?php echo $user['user_id']; ?>">
                                <?php if (empty($user['photo'])) { ?>
                                    <img src='./uploads/avatars/no.jpg' alt="">
                                <?php } else {
                                    ?>
                                    <img src="uploads/avatars/thumbs/<?php echo $user['photo']; ?>" alt="">
                                <?php } ?>
                            </a>

                            <div class="router-user-name">
                                <a href="user.php?uid=<?php echo $user['user_id']; ?>"><?php echo $user['display_name']; ?></a>
                            </div>
                        </div>


                        <a href="project_details.php?pid=<?php echo $project['project_id']; ?>"
                           class="project-title"><?php echo $project['project_title']; ?></a>
                    </div>

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
                    <div style="margin: 15px auto; text-align: center">
                        <p><img src="uploads/images/<?php echo $image; ?>"></p>
                    </div>
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

                    <div class="project-video auto-width">
                        <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="600"
                               height="338" data-setup="{}">
                            <source src="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"/>
                            <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to
                                a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports
                                    HTML5 video</a></p>
                        </video>

                    </div>
                <?php
                }

                $text = getFeaturingText($project['project_id']);
                if (!empty($text)) {
                ?>
                    <div class="form-item no-height"><p align="justify"><?php echo $text; ?></p></div>
                <?php
                }
                }


                $rank = getRankForProject($project['project_id']);
                ?>
                <?php if (!isset($_GET['iid'])){ ?>
                    <div class="home-project-info">
                        <p>Rating: <span><?php echo calculateRating($project['project_id']); ?></span></p>

                        <p>Ranking: <span><?php echo $rank; ?></span></p>

                        <p>Status: <span><?php echo $project['status']; ?></span></p>

                        <p>Analysis:
                            <?php if ($project['created_by'] == $_SESSION['uid']) { ?>
                                <span><a href="project_details.php?pid=<?php echo $project['project_id']; ?>"><img
                                            src="images/icons/stat.png"></a></span>
                            <?php } else {
                                if ($project['privacy'] == 'monetized') { ?>

                                    <span><a href="payment.php?pid=<?php echo $project['project_id']; ?>"
                                             class="showConfirm"
                                             data-monetize="<?php echo $project['monetize']; ?>"><img
                                                src="images/icons/stat.png"></a></span>

                                <?php }
                                if ($project['privacy'] == 'private') { ?>

                                    <span><a href="#" class="showConfirm"><img src="images/icons/stat.png"></a></span>

                                <?php }
                                if ($project['privacy'] == 'public') { ?>

                                    <span><a href="project_details.php?pid=<?php echo $project['project_id']; ?>"><img
                                                src="images/icons/stat.png"></a></span>

                                <?php }
                            } ?>


                        </p>
                    </div>

                    <div id="analizeAccept" class="hidden">
                        <div id="visibleArea" data-balance="<?php echo $authorizedUser['balance']; ?>"
                             data-monetize="<?php echo $project['monetize']; ?>">
                            <?php if ($project['privacy'] == 'monetized') { ?>
                                <div class="slide noMoney hidden">
                                    <p>You have to pay <span
                                            class="chargeAmount">$<?php echo $project['monetize'] > 0 ? $project['monetize'] : ''; ?></span>
                                        to access the analysis of this project.</p>

                                    <br/><br/><br/>
                                    <!-- <a href="#" class="btn" id="acceptPayment"
									data-projectId="<?php echo $project['project_id']; ?>"
									data-createdBy="<?php echo $project['created_by']; ?>"
									data-projectTitle="<?php echo $project['project_title']; ?>"
									data-amount="<?php echo $project['monetize']; ?>"
								>Accept</a> -->
                                    <a href="payment.php?pid=<?php echo $project['project_id'] ?>"
                                       class="btn">Accept</a>
                                </div>
                            <?php }
                            if ($project['privacy'] == 'private') { ?>
                                <div class="slide noMoney hidden" id="notifyTextContent">
                                    <p>You need to request the project owner for permission to access the analysis of
                                        this project.</p>

                                    <br/><br/><br/>

                                    <a href="#" class="btn" id="notifyOwner"
                                       data-projectId="<?php echo $project['project_id']; ?>"
                                       data-createdBy="<?php echo $project['created_by']; ?>"
                                       data-projectTitle="<?php echo $project['project_title']; ?>">
                                        Send Request</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                }
                } ?>
                <!-- homeshare area  -->
            </div>

            <div class="content-block">
                <div class="project-action">
                    <a href="#" class="project-action-btn disabled" id="rate_project" >Rate</a>
                    <a href="#" class="project-action-btn disabled" id="route_project" >Route</a>
                    <a href="#" class="project-action-btn disabled" id="like_project" >Like</a>
                    <a href="#" class="project-action-btn disabled" id="comment_project" >Comment</a>
                    <a href="#" class="project-action-btn disabled" id="report_project" >Report</a>
                    <a href="#" class="project-action-btn" id="homeshare_project">Share</a>
                </div>

                <div class="homeshare-area share-active">
                    <?php
                    if($showProject) {
                        $title = urlencode($project['project_title']);
                        $url = urlencode(SITE_URL . '/view.php?pid=' . $project['project_id']);
                        $summary = getFeaturingText($project['project_id']);
                        $image = getFeaturingImage($project['project_id']);
                        $imageUrl = '/uploads/images/<?php echo $image; ?>';
                    } else{
                        $idea = getIdeaById(intval($_GET['iid']));
                        $title = urlencode($idea['ideathread_title']);
                        $url = urlencode(SITE_URL . '/view.php?pid=' . $idea['ideathread_id']);
                        $summary = $idea['description'];
//                        $imageUrl = '/uploads/images/<?php echo $image;
                        if($idea['thumbnail_img']){
                        $imageUrl=$idea['thumbnail_img'];
                        }else{
                        $imageUrl = '/uploads/avatars/nophoto.jpg';
                        }
                    }
                    ?>
                    <a class="project-action-btns"

                       href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $imageUrl; ?>','facebook','toolbar=0,status=0,width=548,height=325'"
                       target="_blank" title="Click to share"><img src="./images/icons/facebook.png" width="40"
                                                                   height="40"
                                                                   class="img-circle"></a>
                    <a class="project-action-btns"
                       href="https://plus.google.com/share?url=<?php echo $url; ?>"
                       target="_blank" title="Click to share"><img src="./images/icons/gplus.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $url; ?>&via=Rangeenroute"
                       target="_blank" title="Click to share"><img src="./images/icons/twitter.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>"
                       target="_blank" title="Click to share"><img src="./images/icons/linkedin.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="http://reddit.com/submit?url=<?php echo $url; ?>&title=<?php echo $title; ?>"
                       target="_blank" title="Click to share"><img src="./images/icons/reddit.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="mailto:?Subject=<?php echo $title; ?>&Body=<?php echo substr($summary, 0, 50) . ' for more visit. ' . $url;
                       ?>"
                       title="Click to share"><img src="./images/icons/email.png" width="40"
                                                   height="40"></a>
                </div>

            </div>
        </div>


    </div> <!-- account inner-page content -->
    <div id="dialog-message" title="Alert!" style="display: none">
        <h3>You need to login to perform this action.</h3>
    </div>

    <?php include(DIR_INCLUDE . 'right_side.php'); ?>

</div>

<?php include(DIR_INCLUDE . 'footer.php'); ?>

<script>

    $(function() {
        $(".project-action.ideathread").css('display', 'none');

        $(".disabled").click(function (e) {
            e.preventDefault();
            $('#dialog-message').dialog({
                modal: true,
                buttons: {
                    Ok: function () {
                        $(this).dialog("close");
                    }
                }
            });

        });
    });
</script>
