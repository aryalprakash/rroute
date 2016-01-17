<?php
$id = intval($_GET['id']);
$post = getBlogPostById($id);
if (!empty($post)){
$user = getUserData($post['created_by']);
?>
    <div class="content-block">

    <div class="content-title"><?php echo $post['title']; ?></div>
        <p><?php echo getDateformat($post['created_on']); ?></p>


        <?php
        if (!empty($post['thumbnail_img'])) {
            ?>
            <p> <img src="<?php echo SITE_URL.'/uploads/images/blogposts/'.$post['thumbnail_img']; ?>" style="max-width: 100%"></p>
            <?php
        }
        ?>
        <p> <?php echo $post['description']; ?></p>

</div>
    <div class ="content-block">

            <div class="post-title">
             About Author
            </div>
        <div class="content-left-col project-details">
            <div class="user-photo">
                <?php if (empty($user['photo'])) {
                    echo '<a href="user.php?uid=' . $user['user_id'] . '"><img src="uploads/avatars/nophoto.jpg" alt=""></a>';
                } else {
                    echo '<a href="user.php?uid=' . $user['user_id'] . '"><img src="uploads/avatars/' . $user['photo'] . '" alt=""></a>';
                }
                ?>
<!--                <div class="name-block">--><?php //echo $user['display_name']; ?><!--</div>-->
            </div>
        </div>
        <div class="content-right-col project-details">
            <a style="text-decoration: none;" href="user.php?uid=<?php echo $user['user_id']?>"><div class="post-title"><?php echo $user['display_name']; ?></div></a>
            <p align="justify"><?php echo $user['about_me']; ?></p>
        </div>
    </div>
<?php }

else { ?>
    <div class="content-block">
        <div class="content-title">Posts not found</div>
<?php } ?>
