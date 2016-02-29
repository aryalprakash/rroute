<?php require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');?>
<div class="right-side-ads">
    <div class="right-banner"><a href="advertisement.php"><img src="images/180-150-banner.jpg" alt=""></a></div>

    <div class="right-banner banner-post">
        <h1 class="recent-post-title"><a href="<?php echo SITE_URL?>/blog.php">Recent Posts</a></h1>
    <div class="right-recent-post">
        <ul>
        <?php
        $posts = getAllBlogPostVerified();

        if($posts){
            foreach($posts as $ix=>$post){?>



                        <li class="recent-blog-li ">
                       <a href="<?php echo SITE_URL.'/blog.php?id='.$post['post_id']; ?>"> <h1 class="recent-post"> <?php echo ucwords(substr(rtrim(trim($post['title'])),0,30)).'</br>';?></h1></a>
                       <p class="postp"> <?php  echo getDateformat($post['created_on']);?></p>
                        </li>
                        <div class="divline"></div>

           <?php }
        }

        ?>
        </ul>
    </div>
    </div>
</div>


