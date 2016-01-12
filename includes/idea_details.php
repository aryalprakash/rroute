<?php include_once('config.php');
$idea = getIdeaById(intval($_GET['iid']));
$title = $idea['ideathread_title'];
$description = $idea['description'];
$time = TimeAgo(date('Y-m-d', strtotime($idea['created_on'])));
$ideathread_id = $idea['ideathread_id'];
$status = $idea['status'];
$source = $idea['source_url'];
global $project_exists;

$source_details = parse_url($source);

if ($source_details['host']) {
    if ($source_details['host'] == 'host') {
        if ($source_details['path'] == '/home.php') {
            parse_str($source_details['query'], $output);
            if ($output['pid']) {
                $project_exists = true;
                $project_id = $output['pid'];
            }
        } else {
            $project_exists = false;
        }
    } else {
        $project_exists = false;
    }
} else {
    $project_exists = false;
}

if ($idea['thumbnail_img']) {
    $thumbnail = $idea['thumbnail_img'];
} else {
    $thumbnail = 'uploads/avatars/nophoto.jpg';
}

$author = $idea['original_creator'];
$userId = $idea['created_by'];
$user = getUserData($idea['created_by']);
$name = $user['display_name'];

if ($user['photo']) {
    $userphoto = $user['photo'];
} else {
    $userphoto = 'nophoto.jpg';
}

//$likes = $idea['likes'];
//$comments = $idea['comments'];
//$ranking = $idea['ranking'];
//$star = $idea['star'];


if (strlen($title) < 20)
    $short_title = $title;
else
    $short_title = substr($title, 0, 19) . '...';


?>


<div class="user-list-idea idea_<?php echo $ideathread_id ?>" style="min-height: 215px;">

    <div class="content-title">


        <a href="#" class="project-title"><?php echo $title; ?></a>


    </div>


    <div style=" margin: 15px auto; text-align: center;">

        <a href="<?php echo $source ?>" target="_blank"><img src="<?php echo $thumbnail ?>"
                                                             style="max-width: 600px; max-height: 100%;"></a>


    </div>
    <div class="idea-preview" style="padding-left: 0px;">
        <div style="">
            <p class="para-description" align="justify"><?php echo $description; ?></p>

        </div>


    </div>
</div>

<div class="home-project-info">
    <div class="router-user-photo">
        <a href="user.php?uid=<?php echo $user['user_id']; ?>">
            <?php if (empty($user['photo'])) { ?>
                <img src="uploads/avatars/nophoto.jpg" alt="" title="Posted by <?php echo $name ?>">
            <?php } else {
                ?>
                <img src="uploads/avatars/thumbs/<?php echo $user['photo']; ?>" alt=""
                     title="Posted by <?php echo $name ?>">
            <?php } ?>
        </a>

    </div>


    <div class="router-user-photo">
        <a href="#">
            <?php if (empty($user['photo'])) { ?>
                <img src="uploads/avatars/nophoto.jpg" alt="" title="Created by <?php echo $author ?>">
            <?php } else {
                ?>
                <img src="uploads/avatars/nophoto.jpg" alt="" title="Created by <?php echo $author ?>">
            <?php } ?>
        </a>

    </div>

</div>


<div class="project-action">
    <?php if ($project_exists) {
        echo '<a href="' . $source . '" class="project-action-btn inactive showRate"' . '"id="route_project"  >Rate</a>';
        echo '<a href="' . $source . '" class="project-action-btn inactive showRoute"' . '"id="route_project" "data-id="' . $ideathread_id . '" >Route</a>';
    } else {
        echo '<a href="#" class="project-action-btn inactive showtooltipRate" id ="rate_project" data-id="">Rate</a>';
        echo '<a href="#" class="project-action-btn inactive showtooltipRoute" id="route_project" data-id="' . $ideathread_id . '">Route</a>';
    }
    ?>


    <?php if (checkLikedIdea($ideathread_id, $_SESSION['uid'])) { ?>
        <a href="#" class="project-action-btn" id="liked_idea" data-id="<?php echo $ideathread_id ?>" title="Unlike">Liked
            &nbsp;<span class="totalLikes"><?php echo getIdeaLikes($ideathread_id); ?></span></a>
        <a href="#" class="project-action-btn" id="like_idea" data-id="<?php echo $ideathread_id ?>"
           style="display: none;">Like &nbsp;<span
                class="totalLikes"><?php echo getIdeaLikes($ideathread_id); ?></span></a>
    <?php } else { ?>
        <a href="#" class="project-action-btn" id="liked_idea" data-id="<?php echo $ideathread_id ?>"
           style="display: none;">Liked &nbsp;<span
                class="totalLikes"><?php echo getIdeaLikes($ideathread_id); ?></span></a>
        <a href="#" class="project-action-btn" id="like_idea" data-id="<?php echo $ideathread_id ?>">Like &nbsp;<span
                class="totalLikes"><?php echo getIdeaLikes($ideathread_id); ?></span></a>
    <?php } ?>

    <a href="#" class="project-action-btn" id="comment_project" data-id="<?php echo $ideathread_id ?>">Comment
        &nbsp;<span><?php echo countIdeaComments($ideathread_id); ?></span></a>


    <a href="#" class="project-action-btn" id="report_project" data-id="<?php echo $ideathread_id; ?>">Report</a>
    <a href="" class="project-action-btn " id="share_project" data-id="">
        <img src="<?php echo SITE_URL; ?>/images/shareicon.png" width="30" height="20" align="center"/></a>


</div>


<div class="comment-area">
    <form action="" id="comment-form">
        <div class="form-item no-height"><textarea class="comment-idea-textarea"
                                                   data-id="<?php echo $ideathread_id; ?>"></textarea></div>
        <!--<div class="form-item"><input type="submit" value="Add" class="project-action-btn" id="add-comment-btn" data-id="<?php echo $ideathread_id; ?>"></div>-->
    </form>

    <div class="inbox-messages">
        <?php
        $messages = getIdeaComments($ideathread_id);
        if ($messages) {

            foreach ($messages as $ix => $m) {
                ?>
                <div class="idea-message message-item <?php if (($ix % 2) == 0) echo 'odd'; ?>"
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
                    <div class="message-content" data-id="<?php echo $ix; ?>"><?php echo $m['text']; ?></div>

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

<!-- report area -->
<div class="report-area">
    <div class="form-item">This ideathread has issue related to:</div>
    <div class="form-item"><input type="checkbox" id="copyright_issue"> <label for="copyright_issue">Copyright/Privacy/Legal
            infringement</label></div>
    <div class="form-item"><input type="checkbox" id="spam_issue"> <label for="spam_issue">Spam/Deceptive</label></div>
    <div class="form-item"><input type="checkbox" id="violent_issue"> <label for="violent_issue">Violent</label></div>
    <div class="form-item"><input type="checkbox" id="abusive_issue"> <label for="abusive_issue">Abusive</label></div>
    <div class="form-item"><input type="checkbox" id="impersonation_issue"> <label for="impersonation_issue">Impersonation</label>
    </div>
    <div class="form-item"><input type="checkbox" id="harassment_issue"> <label
            for="harassment_issue">Harassment</label></div>
    <div class="form-item report-message">Your report has been sent</div>
    <div class="form-item"><input type="submit" value="Submit" class="project-action-btn" id="report-issue"
                                  data-id="<?php echo $ideathread_id; ?>"></div>
</div>
<!-- Router Area-->
<div id="container" class="route-area">
    <div style="width:296px;float:left;">
        <input type="text" id="route-search" placeholder="Type Your Router Name"/>
        <input type="hidden" id="route-button" value="Search"/>
        <ul id="route-result"></ul>
    </div>
    <div
        style="width:1px;height:50px;float:left;border-left: 2px solid black;position:relative;top:10%;bottom:10%;"></div>
    <div style="width:296px;float:right;margin-left:-20px;">
        <ul class="routed-users">

        </ul>
    </div>
</div>
<!-- share Area-->
<div class="share-area share-active">
    <a class="project-action-btns"
       href="http://www.facebook.com/sharer.php?u=<?php echo SITE_URL . '/home.php?iid=' . $ideathread_id; ?>"
       target="_blank" title="Click to share"><img src="./images/icons/facebook.png" width="40" height="40"
                                                   class="img-circle"></a>
    <a class="project-action-btns"
       href="https://plus.google.com/share?url=<?php echo SITE_URL . '/home.php?iid=' . $ideathread_id; ?>"
       target="_blank" title="Click to share"><img src="./images/icons/gplus.png" width="40" height="40"></a>
    <a class="project-action-btns"
       href="http://twitter.com/share?text=<?php echo substr($title, 0, 50) ?>&url=<?php echo SITE_URL . '/home.php?iid=' . $ideathread_id; ?>&via=Rangeenroute"
       target="_blank" title="Click to share"><img src="./images/icons/twitter.png" width="40" height="40"></a>
    <a class="project-action-btns"
       href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo SITE_URL . '/home.php?iid=' . $ideathread_id; ?>"
       target="_blank" title="Click to share"><img src="./images/icons/linkedin.png" width="40" height="40"></a>
    <a class="project-action-btns"
       href="http://reddit.com/submit?url=<?php echo SITE_URL . '/home.php?iid=' . $ideathread_id; ?>&title=<?php echo $title; ?>"
       target="_blank" title="Click to share"><img src="./images/icons/reddit.png" width="40"
                                                   height="40"></a>
    <a class="project-action-btns"
       href="mailto:?Subject=<?php echo $title; ?>&Body=<?php echo substr($description, 0, 50) . ' for more visit. ' . SITE_URL . '/home.php?iid=' . $ideathread_id;
       ?>"
       title="Click to share"><img src="./images/icons/email.png" width="40"
                                   height="40"></a>
</div>

</div>
</div>


