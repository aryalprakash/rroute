<?php
include('/includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

if (empty($_SESSION['logged_in']))
redirect('index.php');
if(userRole($_SESSION['uid'])=='User')
    redirect('home.php');
?>
<div class="inner-page-wrapper">

        <div class="account inner-page content">

            <?php include(DIR_INCLUDE . 'left_nav.php');?>
            <div class=" admin-content">
                <div class="upload-project-progress">
                    <span class="pagetitle">Actions</span>
                </div>

                <div id="home-tabs">
                    <ul>
                        <li><a href="admin/projectlists.php">Projects</a></li>
                        <li><a href="admin/ideathreadlists.php">Ideathreds</a></li>
                        <li><a href="admin/blogpostlists.php">blogs</a></li>
                        <li><a href="admin/userslists.php">Users</a></li>
                        <li><a href="admin/investorlists.php">Investors</a></li>
                        <li><a href="admin/add_investor.php">Add Investor</a></li>
                        <li><a href="admin/add_post.php">NewsRoom</a></li>

                    </ul>
                </div>

            </div>

        </div> <!-- account inner-page content -->

    <?php include(DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->
<?php include('/includes/footer.php'); ?>
