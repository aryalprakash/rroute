<?php
include('includes/header.php');
require_once(DIR_APP . 'users.php');
require_once(DIR_APP . 'projects.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');

if (isset($_GET['uid']))
    $uid = intval($_GET['uid']);
else
    $uid = $_SESSION['uid'];

if (!isset($_GET['uid']) || $_GET['uid'] == $_SESSION['uid'])
    $own_profile = true;
else
    $own_profile = false;

//print_r($_SESSION);

$user = getUserData($uid);

if (!$user)
    exit();

if (isset($_GET['action']) && $_GET['action'] == 'add_router') {
    AddRouter($uid, $_SESSION['uid']);
    redirect(SITE_URL.'/user.php?uid=' . $uid);
} else if (isset($_GET['action']) && $_GET['action'] == 'remove_router') {
    DeleteRouter($uid, $_SESSION['uid']);
    redirect(SITE_URL.'/user.php?uid=' . $uid);
}

if (isset($_POST['add_foonote']))
    addFootNote($_POST);
?>

    <div class="inner-page-wrapper">

        <div class="inner-page content">

            <?php include(DIR_INCLUDE . 'left_nav.php'); ?>


            <div class="main-content">

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="content-block">
                        <div class="content-title"><?php echo $user['display_name']; ?> <?php if ($user['verified']==True) { ?><img src="images/4.png" title="Verified." "><?php } ?>
                            <div class="add-router">
                                <?php
                                if (!$own_profile) {
                                    $privacy = getPrivacySettings($uid);
                                    $router_settings=$privacy['router_available'];
                                    $status = checkRouter($uid, $_SESSION['uid']);
                                    if ($status == -1) {
                                        if(!empty($options_settings)){ ?>
                                            <?php if ( $router_settings=='1') { ?>
                                                <?php if ($_GET['uid'] != $_SESSION['uid']) { ?>
                                                    <a href="<?php echo SITE_URL; ?>/user.php?action=add_router&uid=<?php echo $uid; ?>"><img
                                                            src="<?php echo SITE_URL; ?>/images/add_route.png" alt=""
                                                            title="Click to add router"></a>
                                                <?php }
                                            }else if ($router_settings=='2'){
                                                if ($_GET['uid'] != $_SESSION['uid']) {
                                                    $routers = getRoutersForUser($_SESSION['uid']);
                                                    $routers_router=getRoutersForUser($_SESSION['uid']);
                                                    if(!empty($routers)) {
                                                        foreach ($routers as $router) {
                                                            if ($router['user_id'] != $_GET['uid']) { ?>
                                                                <a href="<?php echo SITE_URL; ?>/user.php?action=add_router&uid=<?php echo $uid; ?>"><img
                                                                        src="<?php echo SITE_URL; ?>/images/add_route.png"
                                                                        alt=""
                                                                        title="Click to add router"></a>
                                                            <?php }
                                                        }
                                                    }else if(!empty($routers_router)){

                                                        foreach ($routers_router as $routed) {
                                                            $routersrouter=getRoutersForUser($routed['user_id']);

                                                            foreach ($routersrouter as $rout) {
                                                                if ($rout['user_id'] = $_GET['uid']) { ?>

                                                                <?php }

                                                            }

                                                        }
                                                    }
                                                }




                                            }else if ($router_settings=='3') {
                                                echo "";
                                            }


                                        }else{?>

                                            <a href="<?php echo SITE_URL; ?>/user.php?action=add_router&uid=<?php echo $uid; ?>"><img
                                                                            src="<?php echo SITE_URL; ?>/images/add_route.png"
                                                                            alt=""
                                                                            title="Click to add router"></a>

                                    <?php    }

                                    } else if ($status == 1) {
                                        ?>

                                        <a href="<?php echo SITE_URL; ?>/user.php?action=remove_router&uid=<?php echo $uid; ?>"><img
                                                src="<?php echo SITE_URL; ?>/images/routed.png" alt="" title="Click to remove router"></a>
                                        <?php
                                    } else if ($status == 0) {
                                        ?>
                                        <a href="#"><img src="images/connection.png" alt=""
                                                         title="Connection in Process"></a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="content-left-col project-details">
                            <div class="user-photo">
                                <?php
                                if (empty($user['photo'])) {
                                    echo '<img src='.SITE_URL.'/uploads/avatars/nophoto.jpg.'.' alt="">';
                                } else {
                                    echo '<img src='.SITE_URL.'/uploads/avatars/' . $user['photo'] .' alt="">';
                                }
                                ?>
                                <div class="name-block"><a href="<?php SITE_URL.'/user.php?uid='.$user['user_id']; ?>"><?php echo ucwords($user['display_name']); ?></a></div>
                            </div>
                        </div>

                        <div class="content-right-col project-details">
                            <div class="form-item no-height">
                                <ul class="user-info-left">
                                    <li><label>Name:</label><?php echo ucwords($user['display_name']); ?></li>
                                    <li><label>Current City:</label><?php echo $user['location'] ?></li>
                                </ul>

                                <ul class="user-info-right">
                                    <li><label>Hometown:</label><?php echo $user['hometown'] ?></li>
                                    <li><label>Education:</label><?php echo $user['high_school'] ?></li>
                                </ul>
                            </div>

                            <p align="justify"><?php echo $user['about_me']; ?></p>
                        </div>
                    </div>

                    <div class="my-projects content-block">

                        <div class="content-title"><?php
                            if ($own_profile)
                                echo 'My';
                            else
                                echo $user['first_name'] . "'s";
                            ?> Projects
                        </div>


                        <div class="my-projects-list">
                            <?php
                            $projects = getAllUserProjects($uid);
                            //print_r($projects);
                            if (!empty($projects)) {
                                foreach ($projects as $project) {

                                    $title = $project['project_title'];

                                    if (strlen($title) < 20)
                                        $short_title = $title;
                                    else
                                        $short_title = substr($title, 0, 19) . '...';
                                    ?>
                                    <div class="recent-project-item">

                                        <?php $image = getFeaturingImage($project['project_id']);
                                        if (!empty($image)) {
                                            ?>
                                            <a href="<?php echo SITE_URL; ?>/home.php?pid=<?php echo $project['project_id']; ?>"
                                               class="recent-project-title" title="<?php echo $title; ?>"><img
                                                    src="<?php echo SITE_URL . '/uploads/images/thumbs/' . $image; ?>"
                                                    alt=""></a>
                                        <?php } else { ?>
                                            <a href="home.php?pid=<?php echo $project['project_id']; ?>"
                                               class="recent-project-title" title="<?php echo $title; ?>"><img
                                                    src="<?php echo SITE_URL . '/uploads/avatars/nophoto.jpg'; ?>"
                                                    alt=""></a>
                                        <?php } ?>

                                        <div class="project-bottom-details">
                                            <a href="home.php?pid=<?php echo $project['project_id']; ?>"
                                               class="recent-project-title"
                                               title="<?php echo $title; ?>"><?php echo $short_title; ?></a>
                                            <span
                                                class="project-rating"><?php echo calculateRating($project['project_id']); ?></span>
                                        </div> <!-- project-bottom-details -->

                                        <div
                                            class="project-author"><?php echo TimeAgo(date('Y-m-d', strtotime($project['created_on']))); ?>
                                            by <a href="<?php echo SITE_URL; ?>/user.php?uid=<?php echo $project['created_by']; ?>"><?php echo ucwords($user['display_name']); ?></a>
                                        </div>
                                        <?php if ($own_profile) {
                                            echo '
            <div class="project-bottom-details"><a href="upload.php?step=1&id=' . $project['project_id'] . '" class="project-action-btn" style="width:100%; padding:0px 0px; border-radius: 0;">Edit Project</a></div>';
                                        } ?>

                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="my-activity content-block">
                        <div class="content-title"><?php
                            if ($own_profile)
                                echo 'My';
                            else
                                echo ucwords($user['first_name']) . "'s";
                            ?> Activity Logs
                        </div>

                        <div id="home-tabs">
                            <ul>
                                <li><a href="includes/user-tab-activities.php?uid=<?php echo $uid/*$_GET['uid']*/; ?>">Interactions</a>
                                </li>
                                <li>
                                    <a href="includes/user-tab-commented.php?uid=<?php echo $uid/*$_GET['uid']*/; ?>">Projects</a>
                                </li>
                                <li><a href="includes/user-tab-ideathread.php?uid=<?php echo $uid/*$_GET['uid']*/; ?>">IdeaThreads</a>
                                </li>

                            </ul>
                        </div>  <!-- home-tabs -->

                    </div><!-- my-activity content-block -->


                    <div class="my-routers content-block">
                        <div class="content-title"><?php
                            if ($own_profile)
                                echo 'My';
                            else
                                echo $user['first_name'] . 's';
                            ?> Routers
                        </div>
                        <div class="form-item no-height">
                            <?php
                            $routers = getRoutersForUser($uid);
                            if (!empty($routers)) {
                                foreach ($routers as $router) {
                                    $u = getUserData($router['user_id']);
                                    ?>
                                    <div class="router-user-photo">
                                        <a href="user.php?uid=<?php echo $u['user_id']; ?>">
                                            <?php if (empty($u['photo'])) { ?>
                                                <img src="<?php echo SITE_URL; ?>/uploads/avatars/nophoto.jpg" alt="">
                                            <?php } else {
                                                ?>
                                                <img src="<?php echo SITE_URL; ?>/uploads/avatars/<?php echo $u['photo']; ?>" alt="">
                                            <?php } ?>
                                        </a>

                                        <div class="router-user-name">
                                            <a href="user.php?uid=<?php echo $u['user_id']; ?>"><?php echo $u['display_name']; ?></a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div> <!-- my-routers content-block -->


                    <div class="footnote content-block">
                        <div class="content-title">Footnote</div>
                        <?php
                        $myfootnote = getFootnoteByAuthor($user['user_id'], $_SESSION['uid']);
                        $ismyrouter = isMyRouter($user['user_id']);
                        if (!$myfootnote && $ismyrouter) { ?>
                            <form action="" method="post">
                                <div class="form-item no-height"><textarea name="footnote" id="footnote"
                                                                           maxlength="111"></textarea> <input
                                        type="submit" name="add_foonote" value="Add"></div>
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            </form>
                        <?php }

                        $footnotes = getFootnotes($user['user_id']);

                        if ($footnotes) {
                            foreach ($footnotes as $ix => $notes)
                                echo '<p>F' . ($ix + 1) . ':' . $notes['text'] . '</p>';
                        }

                        ?>


                    </div> <!-- footnote content-block -->

            </div> <!-- main-content -->


        </div> <!-- account inner-page content -->

        <?php include(DIR_INCLUDE . 'right_side.php'); ?>

    </div> <!-- inner-page-wrapper -->

<?php include(DIR_INCLUDE . 'footer.php');
?>
