<?php
include ('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');
?>

<div class="inner-page-wrapper">

    <div class="project inner-page content">

        <?php include (DIR_INCLUDE . 'left_nav.php'); ?>


        <div class="main-content">

            <?php
            $projects = getAllUserProjects($_SESSION['uid']);

            if (!empty($projects)) {
                foreach ($projects as $project) {
                    include (DIR_INCLUDE . 'project_stat.php');
                }
            } else {
                ?>
                <div class="content-block"><div class="content-title">You have no projects yet.</div></div>
            <?php }
            ?>


            <div class="content-block">
                <div class="content-title">Connected Projects</div>

                <table class="rating-table table2 connected">
                    <thead>
                        <tr>
                            <td width="70">Project</td><td>Rating</td><td>Ranking</td><td>User Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $projects = getConnectedProjects($_SESSION['uid']);
                        //print_r($projects);

                        if ($projects) {
                        foreach ($projects as $pr) {

                            $project = getProjectById($pr['project_id']);

                            $title = $project['project_title'];
                            $u = getUserData($project['created_by']);
                            ?>

                            <tr>
                                <td>
                                    <?php
                                    $image = getFeaturingImage($project['project_id']);
                                    if (!empty($image)) {
                                        ?>
                                        <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title connected" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/images/thumbs/' . $image; ?>" alt="" width="65" height="55"></a>
                                    <?php } else { ?>
                                        <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title connected" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/avatars/nophoto.jpg'; ?>" alt="" width="65" height="55"></a>
                                        <?php } ?>
                                </td>
                                <td><?php echo calculateRating($project['project_id']); ?></td>
                                <td><?php echo getRankForProject($project['project_id']); ?></td>
                                <td width="200">
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
                                </td>
                            </tr>


                        <?php } 
                        }
                        ?>

                    </tbody>
                </table>

            </div>


        </div>


    </div> <!-- account inner-page content -->

    <?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>