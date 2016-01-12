<?php
include ('includes/header.php');
require_once(DIR_APP . 'projects.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');
?>

<div class="inner-page-wrapper store">

    <div class="inner-page content">

        <?php include (DIR_INCLUDE . 'left_nav.php'); ?>


        <div class="main-content">

            <form action="" method="post">

                <?php if(!empty($_POST['search_text'])){
                        $search=$_POST['search_text'];}
                       else{$search='Search';}

                ?>

                <div class="content-block">
                    <div class="content-title" style="color:#4a77a4">Search for : <?php echo $search;//$_POST['search_text']; ?></div>

                            <?php
                            $projects = searchProjects($search/*$_POST['search_text']*/);
                            $ideathreads = searchIdeathreads($search/*$_POST['search_text']*/);

                            $users = searchUser($search/*$_POST['search_text']*/);
                            $investors=searchInvestor($search);
                            
                            if ($projects) {

                            foreach ($projects as $project) {
                                search_popularity_update($search,$project['project_id']);

                                $user = getUserData($project['created_by']);
                                //$user_email = getUserData($project['created_by']);
                                $title =$project['project_title'];

                                if (strlen($title) < 20)
                                    $short_title = $title;
                                else
                                    $short_title = substr($title, 0, 19) . '...';
                                ?>
                        <div class="recent-project-item">

                            <?php
                            $image = getFeaturingImage($project['project_id']);
                            if (!empty($image)) {
                                ?>
                                <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/images/thumbs/' . $image; ?>" alt=""></a>
                            <?php } else { ?>
                                <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/avatars/nophoto.jpg'; ?>" alt=""></a>
    <?php } ?>

                            <div class="project-bottom-details">
                                <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><?php echo $short_title; ?></a>
                                <span class="project-rating"><?php echo calculateRating($project['project_id']); ?></span>
                            </div> <!-- project-bottom-details -->

                            <div class="project-author"><?php echo TimeAgo(date('Y-m-d', strtotime($project['created_on']))); ?> by <a href="user.php?uid=<?php echo $project['created_by']; ?>"><?php echo $user['display_name']; ?></a></div>


                        </div>
                            <?php }
                            }

                    else if ($ideathreads) {

                            foreach ($ideathreads as $idea) {

                                $user = getUserData($idea['created_by']);
                                //$user_email = getUserData($idea['created_by']);
                                $title =$idea['ideathread_title'];

                                if (strlen($title) < 20)
                                    $short_title = $title;
                                else
                                    $short_title = substr($title, 0, 19) . '...';
                                ?>
                        <div class="recent-project-item">

                            <?php

                            $image = getThumbnailImage($idea['ideathread_id']);
                            if (!empty($image)) {
                                ?>
                                <a href="home.php?iid=<?php echo $idea['ideathread_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/' . $image; ?>" alt=""></a>
                            <?php } else { ?>
                                <a href="home.php?iid=<?php echo $idea['ideathread_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/avatars/nophoto.jpg'; ?>" alt=""></a>
    <?php } ?>

                            <div class="project-bottom-details">
                                <a href="home.php?iid=<?php echo $idea['ideathread_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><?php echo $short_title; ?></a>
                                <span class="project-rating"><?php echo calculateRating($idea['ideathread_id']); ?></span>
                            </div> <!-- project-bottom-details -->

                            <div class="project-author"><?php echo TimeAgo(date('Y-m-d', strtotime($idea['created_on']))); ?> by <a href="user.php?uid=<?php echo $idea['created_by']; ?>"><?php echo $user['display_name']; ?></a></div>


                        </div>
                            <?php }
                            }


                            else if($users){

                                foreach ($users as $user) {
                                    # code...
                                    echo '<div style="width:100%; height:200px;">

                        <div class="left" style="width:250px; float:left;">
                            <div class="user-photo">';?>

                                <?php
                                if (empty($user['photo'])) {
                                    echo '<img src="uploads/avatars/nophoto.jpg" style="width:200px;" alt="">';
                                } else {
                                    echo '<img src="uploads/avatars/' . $user['photo'] . '" style="width:200px;" alt="">';
                                }
                                ?>
                        
                            </div>
                         </div>

                        <div class="right" style="width:639px; float:right;">
                            <div class="form-item no-height">
                                <ul class="user-info-left">
                                <li><div class="content-title-search" ><a href="user.php?uid=<?php echo ucwords($user['user_id']); ?>" style="text-decoration:none; color:#FF4F03;"><?php echo $user['display_name'] ?></a></div></li>
                                <li><h2><?php echo $user['location'] ?></h2></li>
                                <li><h2 style="color:#4a77a4;"><?php echo $user['email'] ?></h2></li>
                                </ul>
                            </div>
                        </div></div>
                        

                

                      <?php  }

                    }

                    else if($investors){

                                foreach ($investors as $investor) {
                                    # code...
                                    echo '<div style="width:100%; height:200px;">

                        <div class="left" style="width:250px; float:left;">
                            <div class="user-photo">';?>

                                <?php
                                if (empty($user['photo'])) {
                                    echo '<img src="uploads/avatars/nophoto.jpg" style="width:200px;" alt="">';
                                } else {
                                    echo '<img src="uploads/avatars/' . $investor['photo'] . '" style="width:200px;" alt="">';
                                }
                                ?>

                            </div>
                         </div>

                        <div class="right" style="width:639px; float:right;">
                            <div class="form-item no-height">
                                <ul class="user-info-left">
                                <li><div class="content-title-search" ><a href="investor.php?iuid=<?php echo ucwords($investor['investor_id']); ?>" style="text-decoration:none; color:#FF4F03;"><?php echo $investor['company_name'] ?></a></div></li>
                                <li><h2><?php echo $investor['location'] ?></h2></li>
                                <li><h2 style="color:#4a77a4;"><?php echo $investor['email'] ?></h2></li>
                                </ul>
                            </div>
                        </div>
                        </div>

                      <?php  }
                    }

                    else {
                        echo '<h2>No Results</h2>';
                    }




?>

                </div>


        </div> <!-- main-content -->


    </div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>