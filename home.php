<?php
include('includes/header.php');
include('includes/ChromePhp.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');
?>
<?php if ($_SESSION['uid']) $authorizedUser = getUserData($_SESSION['uid']); ?>

<div class="inner-page-wrapper">

    <div class="account inner-page user-home-page content">

        <?php include(DIR_INCLUDE . 'left_nav_home.php'); ?>


        <div class="main-content home">
            <div class="profile-home-add">
                <form name="project-action" method="post">
                    <input type="radio" name="type_project[]" id="add_project_radio" value="project"> <label
                        for="add_project_radio">Project</label>
                    <input type="radio" style="margin-left:20%" name="type_project[]" id="add_ideaThread_radio"
                           value="ideaThread"> <label for="add_ideaThread_radio">IdeaThread</label>
                    <input type="submit" name="add_project" value="Upload">
                </form>
            </div>

            <div class="content-block right-home-border">
                <?php global $showProject;
                if (!isset($_GET['pid']) && !isset($_GET['iid'])) {

                    $project = getLastActiveProject();

                    $user = getUserData($_SESSION['uid']);
                    if (empty($project)) {
                        echo '<div class="content-title">You have no projects yet.</div>';
                    } else {
                        $showProject = true;
                    }


                } else if (isset($_GET['pid'])) {

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
                                    <img src="uploads/avatars/nophoto.jpg" alt="">
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


                //                $rank = getRankForProject($project['project_id']);
                ?>
                <?php if (!isset($_GET['iid'])){ ?>
                    <div class="home-project-info">
                        <p>Rating: <span><?php echo calculateRating($project['project_id']); ?></span></p>

                        <p>Ranking: <span><?php // echo $rank; ?></span></p>

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

                    <div class="project-action">
                        <?php
                        $rate = getUserRateForProject($project['project_id'], $_SESSION['uid']);
                        if ($rate) {
                            ?>
                            <a href="#" class="project-action-btn inactive" id="rate_project"
                               data-id="<?php echo $project['project_id'] ?>">Rated</a>
                            <?php
                        } else {
                            $rate = 0;
                            ?>
                            <a href="#" class="project-action-btn" id="rate_project"
                               data-id="<?php echo $project['project_id'] ?>">Rate</a>
                        <?php } ?>


                        <!--                        --><?php //if (checkRoutedProject($project['project_id'], $_SESSION['uid'])) { ?>
                        <!--                            <a href="#" class="project-action-btn route_project" id="routed_project"-->
                        <!--                               data-id="-->
                        <?php //echo $project['project_id'] ?><!--" title="Unroute">Routed</a>-->
                        <!--                            <a href="#" class="project-action-btn route_project" id="route_project"-->
                        <!--                               data-id="-->
                        <?php //echo $project['project_id'] ?><!--" style="display: none;">Route</a>-->
                        <!--                        --><?php //} else { ?>

                        <a href="#" class="project-action-btn route_project" id="routed_project"
                           data-id="<?php echo $project['project_id'] ?>" style="display: none;"
                           title="Unroute">Routed</a>
                        <a href="#" class="project-action-btn route_project" id="route_project"
                           data-id="<?php echo $project['project_id'] ?>">Route</a>

                        <!--                        --><?php //} ?>

                        <a href="#" class="project-action-btn" id="comment_project"
                           data-id="<?php echo $project['project_id'] ?>">Comment
                            &nbsp;<span><?php echo countComments($project['project_id']); ?></span></a>

                        <?php if (checkLikedProject($project['project_id'], $_SESSION['uid'])) { ?>
                            <a href="#" class="project-action-btn" id="liked_project"
                               data-id="<?php echo $project['project_id'] ?>" title="Unlike">Liked &nbsp; <span
                                    class="totalLikes"><?php echo getLikes($project['project_id']); ?></span></a>
                            <a href="#" class="project-action-btn" id="like_project"
                               data-id="<?php echo $project['project_id'] ?>" style="display: none;">Like &nbsp;<span
                                    class="totalLikes"><?php echo getLikes($project['project_id']); ?></span></a>
                        <?php } else { ?>
                            <a href="#" class="project-action-btn" id="liked_project"
                               data-id="<?php echo $project['project_id'] ?>" style="display: none;">Liked &nbsp;<span
                                    class="totalLikes"><?php echo getLikes($project['project_id']); ?></span></a>
                            <a href="#" class="project-action-btn" id="like_project"
                               data-id="<?php echo $project['project_id'] ?>">Like &nbsp;<span
                                    class="totalLikes"><?php echo getLikes($project['project_id']); ?></span></a>
                        <?php } ?>
                        <a href="#" class="project-action-btn" id="report_project"
                           data-id="<?php echo $project['project_id'] ?>">Report</a>
                        <a href="" class="project-action-btn " id="homeshare_project" data-id="">
                            <img src="<?php echo SITE_URL; ?>/images/shareicon.png" width="30" height="20"
                                 align="center"/></a>


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

                        <div class="slider-area"><span class="rate-range">0</span>

                            <div id="slider-range"></div>
                            <span class="rate-range">10</span>
                            <a href="#" class="project-action-btn" id="save_rate_project"
                               data-id="<?php echo $project['project_id'] ?>"
                               data-user="<?php echo $_SESSION['uid']; ?>">Submit</a>
                        </div>
                    </div>   <!-- rate area -->

                    <div class="comment-area">
                        <form action="" id="comment-form">
                            <div class="form-item no-height"><textarea class="comment-textarea"
                                                                       data-id="<?php echo $project['project_id']; ?>"></textarea>
                            </div>
                            <!--<div class="form-item"><input type="submit" value="Add" class="project-action-btn" id="add-comment-btn" data-id="<?php echo $project['project_id']; ?>"></div>-->
                        </form>

                        <div class="inbox-messages">
                            <?php
                            $messages = getComments($project['project_id']);
                            if ($messages) {

                                foreach ($messages as $ix => $m) {
                                    ?>
                                    <div class="message-item <?php if (($ix % 2) == 0) echo 'odd'; ?>"
                                         data-id="<?php echo $ix; ?>">
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
                                        <div class="message-content"
                                             data-id="<?php echo $ix; ?>"><?php echo $m['text']; ?></div>

                                        <?php if ($m['created_by'] == $_SESSION['uid']) { ?>
                                            <div class="delete delete_<?php echo $m['comment_id']; ?>"
                                                 data-id="<?php echo $m['comment_id']; ?>"
                                                 onclick="deleteComment('<?php echo $m['comment_id']; ?>')"></div>
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
                        <div style="width:296px;float:left;">
                            <input type="text" id="route-search" placeholder="Type Your Router Name"
                                   data-id="<?php echo $_SESSION['uid']; ?>"/>
                            <input type="hidden" id="route-button" value="Search"/>
                            <ul id="route-result"></ul>
                        </div>

                        <div style="width:296px;float:right;margin-left:-20px;">
                            <ul class="routed-users">
                                <?php $routers = getRoutersForProject($project['project_id'], $_SESSION['uid']);
                                if ($routers) {
                                    foreach ($routers as $router) {
                                        echo '<div class="routed-users-list" data-id="' . $router['router_id'] . '" user-id="'. $router['routed_to'].'"><span class="unroute" data-id="' . $router['router_id'] . '" user-id="'. $router['routed_to'].'">X</span><a href="' . SITE_URL . '/user.php?uid=' . $router['routed_to'] . '"><li class="routed-name">' . getUserNameById($router['routed_to']) . '</li></a></div>';
                                    }
                                }
                                //                                    ?>
                            </ul>
                            <div class="success-message"></div>
                        </div>
                        <!--                        <div class="routers-set">-->

                        <!--                        </div> <!-- routers-set -->
                    </div> <!-- route-area -->


                           <!-- report area -->
                    <div class="report-area">
                        <div class="form-item">This project has issue related to:</div>
                        <div class="form-item"><input type="checkbox" id="copyright_issue"> <label
                                for="copyright_issue">Copyright/Privacy/Legal infringement</label></div>
                        <div class="form-item"><input type="checkbox" id="spam_issue"> <label for="spam_issue">Spam/Deceptive</label>
                        </div>
                        <div class="form-item"><input type="checkbox" id="violent_issue"> <label for="violent_issue">Violent</label>
                        </div>
                        <div class="form-item"><input type="checkbox" id="abusive_issue"> <label for="abusive_issue">Abusive</label>
                        </div>
                        <div class="form-item"><input type="checkbox" id="impersonation_issue"> <label
                                for="impersonation_issue">Impersonation</label></div>
                        <div class="form-item"><input type="checkbox" id="harassment_issue"> <label
                                for="harassment_issue">Harassment</label></div>
                        <div class="form-item report-message">Your report has been sent</div>
                        <div class="form-item"><input type="submit" value="Submit" class="project-action-btn"
                                                      id="report-issue" data-id="<?php echo $project['project_id']; ?>">
                        </div>
                    </div>


                    <?php
                }
                } ?>
                <!-- homeshare area  -->
                <div class="homeshare-area share-active">
                    <?php
                    $urls =
                    $title=urlencode($project['project_title']);
                    $url=urlencode(SITE_URL . '/home.php?pid=' . $project['project_id']);
                    $summary=$title;
                    $image=urlencode(SITE_URL.'/images/icons/4.png');
                    ?>
                    <a class="project-action-btns"

                       href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $image;?>','facebook','toolbar=0,status=0,width=548,height=325'"
                       target="_blank" title="Click to share"><img src="./images/icons/facebook.png" width="40"
                                                                   height="40"
                                                                   class="img-circle"></a>
                    <a class="project-action-btns"
                       href="https://plus.google.com/share?url=<?php echo SITE_URL . '/home.php?pid=' . $project['project_id']; ?>"
                       target="_blank" title="Click to share"><img src="./images/icons/gplus.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="http://twitter.com/share?text=<?php echo substr($project['project_title'], 0, 50); ?>&url=<?php echo SITE_URL . '/home.php?pid=' . $project['project_id']; ?>&via=Rangeenroute"
                       target="_blank" title="Click to share"><img src="./images/icons/twitter.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo SITE_URL . '/home.php?pid=' . $project['project_id']; ?>"
                       target="_blank" title="Click to share"><img src="./images/icons/linkedin.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="http://reddit.com/submit?url=<?php echo SITE_URL . '/home.php?pid=' . $project['project_id']; ?>&title=<?php echo $project['project_title']; ?>"
                       target="_blank" title="Click to share"><img src="./images/icons/reddit.png" width="40"
                                                                   height="40"></a>
                    <a class="project-action-btns"
                       href="mailto:?Subject=<?php echo $project['project_title']; ?>&Body=<?php echo substr($text, 0, 50) . ' for more visit. ' . SITE_URL . '/home.php?pid=' . $project['project_id'];;
                       ?>"
                       title="Click to share"><img src="./images/icons/email.png" width="40"
                                                   height="40"></a>
                </div>
            </div>

            <div id="home-tabs">
                <ul>
                    <li><a href="includes/home-tab-ideathreads.php">IdeaThreads</a></li>
                    <li><a href="includes/home-tab-recent.php">Recent</a></li>
                    <li><a href="includes/home-tab-trend.php">Trending</a></li>
                    <li><a href="includes/home-tab-activity.php">My Activities</a></li>
                    <li><a href="includes/home-tab-routed.php">Routed</a></li>
                    <li><a href="includes/home-tab-suggestions.php">Suggestions</a></li>
                    <li><a href="includes/home-tab-fundables.php">Fundables</a></li>
                    <li><a href="includes/home-tab-fundabletest.php">Fundablestest</a></li>

                </ul>
            </div>  <!-- home-tabs -->

        </div>


    </div> <!-- account inner-page content -->

    <?php include(DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include(DIR_INCLUDE . 'footer.php'); ?>
<script>$(document).ready(function ($) {
        var form = $('form[name="project-action"]'),
            radio = $('input[name="type_project[]"]'),
            choice = '';

        radio.change(function (e) {
            choice = this.value;
            console.log(choice);

            if (choice == 'project') {
                form.attr('action', 'upload.php');
            } else {
                form.attr('action', 'uploadidea.php');
            }
        });

        $(document).on('click', '.showConfirm', function (e) {
            box = $('#visibleArea');
            if (parseInt(box.attr('data-balance')) < parseInt(box.attr('data-monetize'))) {
                box.children('.noMoney').removeClass('hidden');
            }
            else {
                box.children('.accept').removeClass('hidden');
            }
            e.preventDefault();
            $.fancybox({
                'content': $("#analizeAccept").html()
            });
        });


    });</script>