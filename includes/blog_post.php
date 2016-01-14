<?php
$id = intval($_GET['post_id']);
$post = getBlogPostById($id);
if (!empty($post)){
$user = getUserData($post['created_by']);
?>
    <div class="content-block">
    <div class="content-left-col project-details">
        <div class="user-photo">
            <?php if (empty($user['photo'])) {
                echo '<a href="user.php?uid=' . $user['user_id'] . '"><img src="uploads/avatars/nophoto.jpg" alt=""></a>';
            } else {
                echo '<a href="user.php?uid=' . $user['user_id'] . '"><img src="uploads/avatars/' . $user['photo'] . '" alt=""></a>';
            }
            ?>
            <div class="name-block"><?php echo $user['display_name']; ?></div>
        </div>
    </div>


    <div class="post-title"><?php echo $post['title'];?></div>

    <p> <?php echo $post['description']; ?></p>
        <?php  if (!empty($post['thumbnail_img'])) {
            ?>
            <p> <img src="<?php echo $post['thumbnail_img']; ?>" style="width: 60%"></p>
            <?php
        }?>
</div>

<?php }

else { ?>
    <div class="content-block">
        <div class="content-title">Posts not found</div>
<?php } ?>