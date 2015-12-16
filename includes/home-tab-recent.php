<?php
include_once('config.php');
include_once('app/projects.php');
include_once('app/users.php');
if (empty($_SESSION['logged_in']))
    redirect('index.php');

if (isset($_GET['uid']))
    $uid = intval($_GET['uid']);
else
    $uid = $_SESSION['uid'];

$projects = getAllRecentProjects($uid);


if ($projects) {

    foreach ($projects as $project) {

        $title = $project['project_title'];
        $user = getUserData($project['created_by']);

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
        <?php
    }
}
?>