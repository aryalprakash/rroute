<?php
include_once('config.php');
include_once('app/users.php');
include_once('app/projects.php');



$ideas = getIdeas('all');
global $project_exists;//aded to remove error random line code
if ($ideas) {

    foreach ($ideas as $idea) {
        $title = $idea['ideathread_title'];
        $description = $idea['description'];
        $time = TimeAgo(date('Y-m-d', strtotime($idea['created_on'])));
        $ideathread_id = $idea['ideathread_id'];
        $status = $idea['status'];
        $source= $idea['source_url'];

        $source_details = parse_url($source);
        if($source_details['host'] == 'rangeenroute.com' || $source_details['host'] == 'www.rangeenroute.com'){
            if($source_details['path'] == '/home.php' ){
                parse_str($source_details['query'], $output);

                if($output['pid']){
                    $project_exists = true;
                    list($url, $project_id) = explode("=", $source);

                }
            }
        }

        if($idea['thumbnail_img']){
            $thumbnail=$idea['thumbnail_img'];
        }else{
            $thumbnail = '/uploads/avatars/nophoto.jpg';
        }

        $author = $idea['original_creator'];
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

        <div class="user-list-idea" style="margin-left: 10px;">



            <div class="thumb-img" style="float: left">

                <a href="<?php echo $source ?>" target="_blank" ><img src="<?php echo $thumbnail; ?>" height="100%" width="100%"></a>


            </div>
            <div class="idea-preview" >
                <div class="seventy left" style="margin-bottom: -15px;">
                    <a class="" href="<?php echo SITE_URL . '/view.php?iid=' . $ideathread_id ?>" style="text-decoration: none;"><h1 class="idea-title"><?php echo $title; ?></h1></a>
                    <span class="hueued"><?php echo $time ?></span> &nbsp; &nbsp;<span class="hueued"></span>
                    <p class="idea-description"><?php echo $description; ?></p>
                </div>
                <div class="thirty right" style="">
                    <div style="width: 50%; float: left" class="">
                        <div class="idea-stats"><a href="#">
                                <img src="./images/icons/star.jpg" /></a><div class="stat-no"><?php if($project_exists){echo calculateRating($project_id);}?></div></div>
                        <div class="idea-stats"><a href="#">
                                <img src="./images/icons/ranking.png" /></a><div class="stat-no"><?php if($project_exists){echo getRankForProject($project_id);}?></div></div>
                        <div class="idea-stats"><a href="#">
                                <img src="./images/icons/like.png" /></a><div class="stat-no"><?php echo $likes ?></div></div>
                        <div class="idea-stats"><a href="#">
                                <img src="./images/icons/comment.jpg"/></a><div class="stat-no"><?php echo $comments ?></div></div>
                    </div>
                    <div style=" float: right">

                        <div class="thumb"><a href="#">
                                <img src="uploads/avatars/thumbs/<?php echo $userphoto ?>" title="Posted by <?php echo $name ?>">
                            </a></div>
                        <div class="thumb"><img src="./uploads/avatars/nophoto.jpg" title="Created by <?php echo $author ?>"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="line index"></div>

        <?php
//        $last_id =$idea['ideathread_id'];//for ordering by id
    }
    ?>
    <div  class="more-idea" style="">
        <input type="button" class="load-more" value="View More" data-id="0"/>
    </div>

    <?php

}else{
    echo '<div class="project-title" style="font-size: 20px; margin-left: 10px;">No Ideathreads available right now.</div>';
}
?>