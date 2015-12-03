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



                <div class="content-block">
                    <div class="content-title">Search for "<?php echo $_POST['search_text']; ?>":</div>

                            <?php
                            $projects = searchProjects($_POST['search_text']);  
                            $users = searchUser($_POST['search_text']);                  
                            
                            if ($projects) {

                            foreach ($projects as $project) {
                                
                                $user = getUserData($project['created_by']);
                                $title = $project['project_title'];

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
                                <li><div class="content-title" style="font-size:30px;"><a href="user.php?uid=<?php echo $user['user_id']; ?>" style="text-decoration:none; color:black;"><?php echo $user['display_name'] ?></a></div></li>
                                <li><h2><?php echo $user['location'] ?></h2></li>
                                </ul>
                            </div>
                        </div></div>
                        

                

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