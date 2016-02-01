
<?php
$posts = getAllBlogPostVerified();
if ($posts) {
    foreach ($posts as $post){
        $user =getUserData($post['created_by']);
?><div class="content-block">
        <div class="content-left-colm project-details">
            <div class="post-photo">
                <?php if (empty($post['thumbnail_img'])) {

                    echo '<a href="blog.php?id=' . $post['post_id'] . '"><img src="'.SITE_URL.'/uploads/avatars/nophoto.jpg" alt="">';
                     //echo '<img src=' . SITE_URL . '/uploads/avatars/nophoto.jpg.' . ' alt="">';
                   echo  '</a>';
                } else {
                    $photo =$post['thumbnail_img'];
                    echo '<a href="blog.php?id=' . $post['post_id'] . '"><img src="'.SITE_URL.'/uploads/images/blogposts/'. $photo . '" alt=""></a>';
                }
                ?>
                <div class="name-block"><?php echo 'Author: '.ucwords($user['display_name']); ?></div>
            </div>
        </div>
        <div class="post-title"><a href="blog.php?id=<?php echo $post['post_id']; ?>"><?php echo ucwords($post['title']);?></a></div>

        <p> <?php echo substr($post['description'],0,150); ?>...<a href="blog.php?id=<?php echo $post['post_id'];?>" title="Read More.">More</a></p>


        <!--<div class="content-title">-->
<!--    <div class="router-user-photo">-->
<!--        <a href="user.php?uid=--><?php //echo $user['user_id']; ?><!--">-->
<!--            --><?php //if (empty($user['photo'])) { ?>
<!--                <img src="uploads/avatars/nophoto.jpg" alt="">-->
<!--            --><?php //} else {
//                ?>
<!--                <img src="uploads/avatars/thumbs/--><?php //echo $user['photo']; ?><!--" alt="">-->
<!--            --><?php //} ?>
<!--        </a>-->
<!---->
<!--        <div class="router-user-name">-->
<!--            <a href="user.php?uid=--><?php //echo $user['user_id']; ?><!--">--><?php //echo $user['display_name']; ?><!--</a>-->
<!--        </div>-->
<!--    </div>-->
<!--    -->
<!--    <a href="blog_posts.php?post_id=--><?php //echo $post['post_id']; ?><!--"-->
<!--       class="project-title">--><?php //echo $post['title']; ?><!--</a>-->
<!---->
<!--</div>-->

<?php
//    if (!empty($post['description'])) {
//        ?>
<!--        <div class="form-item no-height" style="align-content: right;" ><p>--><?php //echo substr($post['description'],0,50); ?><!--</p>-->
<!--        </div>-->
<!---->
<!--        --><?php
//    }
////        if (!empty($post['thumbnail_img'])) {
////            ?><!--<!--<div>-->
<!--<!--            <img src="--><?php ////echo $post['thumbnail_img']; ?><!--<!--" width="52%"></div>-->
<!--<!--            --><?php
////        }?>


</div>
<?php
    }
} else{
    ?>
    <div class="content-block">
        <div class="content-title">Posts not found</div>
    <?php

}?>