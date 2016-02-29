<?php
include('includes/header.php');
require_once(DIR_APP . 'users.php');
require_once(DIR_APP . 'projects.php');
//if (empty($_SESSION['logged_in']))
//    redirect('index.php');
?>
    <div class="inner-page-wrapper">

        <div class="inner-page content">

            <?php if (!empty($_SESSION['logged_in']))
                 include(DIR_INCLUDE . 'left_nav.php');
            ?>

            <div class="admin-content">
                <div class="upload-project-progress">
                    <span class="pagetitle">Blog</span>
                </div>
                <?php  if(!isset($_GET['id']))
                    require(DIR_INCLUDE .'blog_postlists.php');
                else
                    require(DIR_INCLUDE . 'blog_post.php');
                ?>
<!--                    --><?php //if (isset($_GET['pid'])) {
//                    $id = intval($_GET['pid']);
//                    $posts = getBlogPostById($id);
//                    if (!empty($posts))
//                    require(DIR_INCLUDE . 'blog_post.php');
//                    else { ?>
<!--                    <div class="content-block">-->
<!--                        <div class="content-title">Posts not found</div>-->
<!--                        --><?php //}
//                        }
//                        ?>



            </div> <!-- main-content -->

        </div> <!-- account inner-page content -->

        <?php include(DIR_INCLUDE . 'right_side.php'); ?>

    </div> <!-- inner-page-wrapper -->

<?php include(DIR_INCLUDE . 'footer.php');
?>